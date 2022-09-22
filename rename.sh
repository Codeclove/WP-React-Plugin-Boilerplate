#!/bin/bash
removed_dash="$(echo $1 | tr '-' ' ' )" 
original_arr=($removed_dash)
capitalize="${original_arr[@]^}"
underscore="$(echo $1 | tr '-' '_' )"
capitalize_with_underscore="$(echo $capitalize | tr ' ' '_' )" 
uppercase="${capitalize_with_underscore^^}_"

#Rename keywords in files
find ./ -type f -not -path '*/\.git/*' -exec sed -i -e "s/test-plugin/$1/g" {} \;
find ./ -type f -not -path '*/\.git/*' -exec sed -i -e "s/test_plugin/$underscore/g" {} \;
find ./ -type f -not -path '*/\.git/*' -exec sed -i -e "s/Test_Plugin/$capitalize_with_underscore/g" {} \;
find ./ -type f -not -path '*/\.git/*' -exec sed -i -e "s/TEST_PLUGIN_/$uppercase/g" {} \;
#Rename files
find ./ -name "*" -exec rename "s/test-plugin/$1/g" *test-plugin* {} ";" 