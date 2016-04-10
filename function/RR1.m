%% Compile the code
% mcc -m RR1 intrinsic_images.m

%% Set Work Directory!!!!
wd = '/Users/jixiang/Documents/ISS/SEProject/team_git/webapp/';
%wd = '/Users/jixiang/Documents/ISS/SEProject/team_git/webapp/DEMO_RR1-RR2'; % For Test

%% Set Path & Scan Images

path_intr_jpg = [wd,'/resource/'];
list_intr_jpg = dir([path_intr_jpg,'*.jpg']);
num_intr_jpg = length(list_intr_jpg);

path_intr_png = [wd,'/resource/'];
list_intr_png = dir([path_intr_png,'*.png']);
num_intr_png = length(list_intr_png);

cd ..
if ~exist('result','dir')
        mkdir('result');
end
cd function

logpath = fopen('../result/RR1_log.txt','w');
fprintf(logpath,'LOG\n');


%% Intrinsic Image Decomposition

disp('Intrinsic Image Decomposition');

for i=1:num_intr_jpg
    lambda = 2;  % Can be tuned
    fprintf(logpath,'\nProcessing intrinsic_images-%d...\n',i);
    path = [path_intr_jpg,list_intr_jpg(i).name]; 
    I = im2double(imread(path));
    [R S time] = intrinsic_images(I,lambda);
    fprintf(logpath,'Time consumption: %.4fs\n',time);
    
    cd ../result
    %saveas(imshow(S),['shading_',num2str(floor(time*1000))],'png');
    %saveas(imshow(R),['reflection_',num2str(floor(time*1000))],'png');
    imwrite(S,['shading_',num2str(floor(time*1000)),'.png']);
    imwrite(R,['reflection_',num2str(floor(time*1000)),'.png']);
    cd ../function
end

for i=1:num_intr_png
    lambda = 2;  % Can be tuned
    fprintf(logpath,'\nProcessing intrinsic_images-%d...\n',i);
    path = [path_intr_png,list_intr_png(i).name]; 
    I = im2double(imread(path));
    [R S time] = intrinsic_images(I,lambda);
    fprintf(logpath,'Time consumption: %.4fs\n',time);
    
    cd ../result
    %saveas(imshow(S),['shading_',num2str(floor(time*1000))],'png');
    %saveas(imshow(R),['reflection_',num2str(floor(time*1000))],'png');
    imwrite(S,['shading_',num2str(floor(time*1000)),'.png']);
    imwrite(R,['reflection_',num2str(floor(time*1000)),'.png']);
    cd ../function
end

fclose(logpath);
disp('ALL DONE!');
