#!/bin/sh

ffmpeg -i $1 -vf scale=512:-1 $2
