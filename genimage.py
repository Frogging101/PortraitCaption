#   Copyright (C) 2013 OHRI 
#
#   This file is part of PortraitCaption.
#
#   PortraitCaption is free software: you can redistribute it and/or modify
#   it under the terms of the GNU General Public License as published by
#   the Free Software Foundation, either version 3 of the License, or
#   (at your option) any later version.
#
#   PortraitCaption is distributed in the hope that it will be useful,
#   but WITHOUT ANY WARRANTY; without even the implied warranty of
#   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#   GNU General Public License for more details.
#
#   You should have received a copy of the GNU General Public License
#   along with PortraitCaption.  If not, see <http://www.gnu.org/licenses/>.


#!/usr/bin/env python
import os
import subprocess
import textwrap
import math
from sys import argv

fileExt = ""

if len(argv) < 4 or len(argv) > 5:
    print "Usage: genimage <source filename> \"<name>\" \"<title>\" [--pdf|--png]"
    exit(0)

if len(argv) == 5:
    if argv[4] == "--pdf":
        fileExt = ".pdf"
    elif argv[4] == "--png":
        fileExt = ".png"
    else:
        print "Usage: genimage <source filename> \"<name>\" \"<title>\" [--pdf|--png]"
        exit(0)
 
nameSize = 80
titleSize = 45
 
#These values have been calculated to give an output image of the desired aspect ratio
#See docs
idealInputWidth = 640
idealInputHeight = 670
heightDifference = 0
 
widthDifference = 0
 
printOutput = subprocess.check_output("convert "+argv[1]+" -resize 640x670 -print \"size;%w;%h\" /dev/null;exit 0", shell=True, stderr=subprocess.STDOUT)
if printOutput.split(';')[0] != "size":
    print "An error occurred. The file probably doesn't exist."
    print "Full error text:"
    print printOutput
    exit(0)
else:
    widthDifference = idealInputWidth-int(printOutput.split(';')[1])
    heightDifference = idealInputHeight-int(printOutput.split(';')[2])
 
sizeGood = False
 
while not sizeGood:
    debugOutput = subprocess.check_output("convert -debug annotate  xc: -font Helvetica \
  -pointsize "+str(nameSize)+" -annotate 0 \""+argv[2]+"\" null;exit 0", shell=True, stderr=subprocess.STDOUT)
    textWidth = int(float(debugOutput[debugOutput.find("width: ")+len("width: "):].split(';')[0]))
    if textWidth < idealInputWidth:
        sizeGood = True
    else:
        nameSize -= 1
 
sizeGood = False
while not sizeGood:
    debugOutput = subprocess.check_output("convert -debug annotate  xc: -font Helvetica \
  -pointsize "+str(titleSize)+" -annotate 0 \""+argv[3]+"\" null;exit 0", shell=True, stderr=subprocess.STDOUT)
    textWidth = int(float(debugOutput[debugOutput.find("width: ")+len("width: "):].split(';')[0]))
    if textWidth < idealInputWidth:
        sizeGood = True
    else:
        titleSize -= 1
 
name = argv[2] #name
title = argv[3] #title

nameOffset = int(round(((80.0-nameSize)/80.0)*100.0+20.0))
titleOffset = nameOffset+10+((-(80.0-nameSize)/80.0)*100.0)

print titleOffset

os.system("convert "+argv[1]+" -resize "+str(idealInputWidth)+"x"+str(idealInputHeight)+" -background '#1531b4' \
-bordercolor '#1531b4' -gravity northeast -splice "+str(math.ceil(widthDifference/2.0))+"x0 \
-gravity southwest -splice "+str(widthDifference/2)+"x0 -gravity north -border 225x225 -font Helvetica \
-pointsize "+str(nameSize)+" -splice 0x"+str(math.ceil(heightDifference/2.0))+" \
-fill white -shave 200x0 -chop 0x200 -gravity southwest -splice 0x"+str(heightDifference/2)+" \
-annotate +25+"+str(nameOffset)+"% \""+name+"\\n\" -pointsize "+str(titleSize)+" \
-annotate +25+"+str(titleOffset)+"% \""+title+"\" -units PixelsPerCentimeter -density 125.74 \""+argv[2].replace(" ", "")+fileExt+"\"")
