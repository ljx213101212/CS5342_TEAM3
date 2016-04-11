clear;
% clearvars -except case_idx 

addpath('SiftFlow');
addpath('Sift');
addpath(genpath('MatlabFns'));

warning('off', 'MATLAB:nearlySingularMatrix');

tic;

%%%%%%%%%%%%%%%%%%%%%%%% Directory %%%%%%%%%%%%%%%%%%%%%%%%
% wd = 'D:\Course-Sixing\CS5342-Multimedia Computing and Application\Project\ReflectionRemoval\pic\';
% input_path = [wd, 'resource\'];
% output_path = [wd, 'result\'];
wd = '/Users/jixiang/Documents/ISS/SEProject/team_git/webapp/';

% FOR TEST!!!!!!!!!!!!!!!!!!!!
%temp = cellstr(pwd);
%wd = [temp{1},'/../DEMO_RR3/'];

input_path = [wd, 'resource/'];
output_path = [wd, 'result/'];


%%%%%%%%%%%%%%%%%%%%%%%% Read images %%%%%%%%%%%%%%%%%%%%%%%%
img_names = [dir(fullfile(input_path, '*.jpg')); dir(fullfile(input_path, '*.png'))];
img_names = {img_names.name};


num_of_img = length(img_names);
image = cell(1, num_of_img);
for i = 1 : num_of_img
    image{i} = im2double(imread(fullfile(input_path, img_names{i})));
    image{i} = imresize(imfilter(image{i}, fspecial('gaussian',7,1.), 'same', 'replicate'), 0.5, 'bicubic');
end


%%%%%%%%%%%%% Estimate inverse-warping functions %%%%%%%%%%%%%
% extract SIFT features
sift_feature = cell(1, num_of_img);
cellsize = 8;
gridspacing = 1;
fprintf('extract SIFT features (%d): ', num_of_img);
for i = 1 : num_of_img
    fprintf('%d ', i);
%     sift_feature{i} = mexDenseSIFT(image{i}, cellsize, gridspacing);
    sift_feature{i} =  dense_sift(image{i},cellsize,gridspacing);
end

% estimate SIFT flow
fprintf('\nestimate SIFT flow (%d): ', num_of_img-1);
SIFTflowpara.alpha = 2;
SIFTflowpara.d = 40;
SIFTflowpara.gamma = 0.005;
SIFTflowpara.nlevels = 4;
SIFTflowpara.wsize = 5;
SIFTflowpara.topwsize = 20;
SIFTflowpara.nIterations = 60;
vx = cell(1, num_of_img);
vy = cell(1, num_of_img);
energylist = cell(1, num_of_img);
for i = 2 : num_of_img
    fprintf('%d ', i);
    [vx{i}, vy{i}, energylist{i}] = ...
        SIFTflowc2f(double(sift_feature{1}), double(sift_feature{i}), SIFTflowpara);
end

% compute gradient magnitudes
kernel = fspecial('sobel');
gradient = cell(1, num_of_img);
for i = 1 : num_of_img
    for j = 1 : 3 % RGB channel
        gx(:, :, j) = imfilter(image{i}(:, :, j), kernel);
        gy(:, :, j) = imfilter(image{i}(:, :, j), kernel');
    end
    gradient{i} = sqrt(gx .^ 2 + gy .^ 2);
    gradient{i} = max(gradient{i}, [], 3);
end

% estimate warped images
img_warped = cell(1, num_of_img);
grad_warped = cell(1, num_of_img);
for i = 1: num_of_img
    img_warped{i} = image{i}(cellsize/2 : end - cellsize/2 + 1, cellsize / 2 : end - cellsize/2 + 1, :);
    grad_warped{i} = gradient{i}(cellsize/2 : end - cellsize/2 + 1, cellsize/2 : end - cellsize/2 + 1);
    if i ~= 1
        img_warped{i} = warpImage(img_warped{i}, vx{i}, vy{i});
        grad_warped{i} = warpImage(grad_warped{i}, vx{i}, vy{i});
    end
    gradients_warped(:, :, i) = grad_warped{i};
end


%%%%%%%%%% Edge separation & Layer Reconstruction %%%%%%%%%%
fprintf('\nEdge separation & Layer Reconstruction\n');
% edge separation
grad_threshold = 0.3; 
% edge_s_t = sum(bsxfun(@rdivide,gradients_warped,sum(gradients_warped,3)).^2,3);
[rows_grad, cols_grad, ~] = size(grad_warped{1});
denominator = sum(gradients_warped, 3) .^ 2;
edge_s_t = zeros(rows_grad, cols_grad);
for i = 1 : num_of_img
    % parameter of sigmoid function s(t), Equation (5) in paper
    edge_s_t = edge_s_t + gradients_warped(:, :, i) .^ 2 ./ denominator;
end

% layer reconstruction
L_reflection = cell(1, num_of_img);
L_background = cell(1, num_of_img);
% parameter matrix for recondsturctLayer function
G = getG(rows_grad, cols_grad);
fprintf('Reconstruct layer - iterative reweighted least square (%d): \n   ', num_of_img);
for i = 1: num_of_img
    fprintf('%d ', i);
    P_reflection_edge =  imadjust(edge_s_t) .* (grad_warped{i} > grad_threshold);
    P_reflection_edge = 1 ./ (1 + exp(-(P_reflection_edge - 0.05) / 0.05));
    P_background_edge = (1 - P_reflection_edge) .* (grad_warped{i} > grad_threshold);
    E_reflection = find((P_reflection_edge > 0.6) == 1);
    E_background = find((P_background_edge > 0.6) == 1);
    for j = 1:3
        [L_reflection{i}(:,:,j), L_background{i}(:,:,j)] = reconstructLayer(img_warped{i}(:, :, j), G, E_reflection, E_background);
    end
end


%%%%%%%%%%%%%%%%%%%% Combine the results %%%%%%%%%%%%%%%%%%%%
fprintf('\nCombine the results\n');
img_recovered = L_background{1};
for i = 2 : num_of_img
     img_recovered = min(img_recovered, L_background{i});
end

total_time = floor(toc * 1000);

% fprintf('\ntotal time = %fs\n', toc);
% figure,
% subplot(1, 2, 1);
% imshow(img_recovered);
% title('Recovered Image');
% subplot (1, 2, 2);
% imshow(img_warped{1} - img_recovered);
% title('Reflection Layer');
                
imwrite(img_recovered, [output_path, 'background_', int2str(total_time),'.png']);
imwrite(img_warped{1} - img_recovered, [output_path, 'reflection_', int2str(total_time), '.png']);

