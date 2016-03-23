#!/bin/bash

cd  /Users/jixiang/Documents/MATLAB/finalProject_demo

export PATH="/Applications/MATLAB_R2015a.app/bin:$PATH"
matlab -nodesktop -nojvm -nosplash -r "demo('$1')"