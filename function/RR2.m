%% Compile the code
% mcc -m RR2 reflection_removal.m

%% Set Work Directory!!!!
%wd = '/Users/lijixiang/Documents/ISS/SEProject';
wd = '/Users/lijixiang/Documents/ISS/SEProject/DEMO_RR1&RR2'; %%% For Test 

%% Set Path & Scan Images

path_rmrf_jpg = [wd,'/resource/'];
list_rmrf_jgp = dir([path_rmrf_jpg,'*.jpg']);
num_rmrf_jgp = length(list_rmrf_jgp);

path_rmrf_png = [wd,'/resource/'];
list_rmrf_png = dir([path_rmrf_png,'*.png']);
num_rmrf_png = length(list_rmrf_png);

cd ..
if ~exist('result','dir')
        mkdir('result');
end
cd function

logpath = fopen('../result/RR2_log.txt','w');
fprintf(logpath,'LOG\n');

%% Reflection Removal 

disp('Reflection Removal');

for i=1:num_rmrf_jgp
    lambda = 10;  % Can be tuned
    fprintf(logpath,'\nProcessing reflection_removal-%d...\n',i); 
    path = [path_rmrf_jpg,list_rmrf_jgp(i).name]; 
    I = im2double(imread(path));
    [LB LR time] = reflection_removal(I,lambda);
    fprintf(logpath,'Time consumption: %.4fs\n',time);
    
    cd ../result
    saveas(imshow(LB*1.5),['background_',num2str(floor(time*1000))],'png');
    saveas(imshow(LR*1.5),['reflection_',num2str(floor(time*1000))],'png');
    cd ../function
end

for i=1:num_rmrf_png
    lambda = 10;  % Can be tuned
    fprintf(logpath,'\nProcessing reflection_removal-%d...\n',i); 
    path = [path_rmrf_png,list_rmrf_png(i).name]; 
    I = im2double(imread(path));
    [LB LR time] = reflection_removal(I,lambda);
    fprintf(logpath,'Time consumption: %.4fs\n',time);

    cd ../result
    saveas(imshow(LB*1.5),['background_',num2str(floor(time*1000))],'png');
    saveas(imshow(LR*1.5),['reflection_',num2str(floor(time*1000))],'png');
    cd ../function
end

fclose(logpath);
disp('ALL DONE!');
