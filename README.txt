# CS5342_TEAM2

NOTE: 
The function of our website and server side will be presented when we do our DEMO in the classroom.
The presentation will be based on our webpage, hence right now we don't offer any PPT slides. 

Environment configuration:

Apache v2.4.18
php v5.6.10
Matlab_R2015a

Route configuration:

1. change line 107 in index.html,index2.html and index3.html into your server path
   eg: "http://YourServerDocumentationRoute:yourport/webapp/php_helper.php" (for index.html,index2.html)
       "http://YourServerDocumentationRoute:yourport/webapp/php_helper_multiple.php"(for index3.html)
2. change line 3 ,line 4 in start.sh file, for line3, you need to change reference your sever path
   eg: "cd "/YourServerPathInLocalFormat/webapp/function/"
   For line 4, you need to add matlab environment into current terminal.
   eg(on Mac) "export PATH="/YourServerPathInLocalFormatToMatlabInstallation/MATLAB_R2015a.app/bin:$PATH""
3. change line 9 in function/RR1.m , RR2.m and line 16 in function/RR3.m  into your apache documentation root
   eg: "/Users/jixiang/Documents/ISS/SEProject/team_git/webapp/"

4. change line 14 in php_constants.php to measure the host file structure into apache documentation root
   eg:  "/Users/jixiang/Documents/ISS/SEProject/team_git/webapp/"


Basic Usage
1.Put this project folder "Webapp" into apache server root folder
2.index.html(default),index2.html,index3.html are prepared for RR1,RR2,RR3 presentation respectively.
3.The hamburger box on the upper-left could be used for switch the pages for different demonstration.
Notice: RR3 function needs 5 around minutes to be fully executed.
        So you need to be a little patient once you upload a patch of images

Documentation structure:
webapp(root):
    -function (matlab source code)
        --RR1.m (Relative Smoothness 1 entry)
        --RR2.m (Relative Smoothness 2 entry)
        --RR3.m (Reflection Change entry)
        --*....(related function for above entries)
    -php_*.php(Server-side code)
    -start.sh(matlab code invoker)
    -result*.php(result page for displaying different results)
    -index*.html(HTML5 pages)
    -js(Referenced Javascript code)
    -css(Referenced CSS code)
    -fonts
    -resource(input images)
    -result(output images)
    -DEMO_RR1-RR2(demo input images source for RR1&RR2 function)
    -DEMO_RR3(demo input images source for RR3 function)


Simple guide for test our codes
1) load this whole package/folder in MATLAB
2-1) Under '/function', run RR1.m, RR2.m respectively for testing Layer Separation based on Relative Smoothness.
2-2) Under '/function', run RR3.m for testing Layer Separation based on Separation based on Reflection Change.
3-1) Refer to '/result' for checking the output images.
3-2) Refer to '/DEMO_RR3/result' for checking the output images. 
NOTE: Each output image's name indicates the time consumption (ms).

Each member’s contribution to this project:

CHI JI: 
    1) Survey & Discussion; 
    2) Data collection;
    3) Implementation of layer separation algorithm based on Relative Smoothness on MATLAB;
    4) Report;
    
HU SIXING:
    1) Survey & Discussion; 
    2) Data collection;
    3) Implementation of layer separation algorithm based on Reflection Change on MATLAB;
    4) Report;

LI JIXIANG: 
    1) Survey & Discussion; 
    2) Data collection;
    3) Webpage Development;
    4) Server-Side Development;
    
    
