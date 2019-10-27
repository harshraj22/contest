
# command line input : filename timeAllowed

# return values :
    # 1 for WA
    # 0 for AC
    # 2 for compilation error
    # 3 for RTE/TLE

# support for errors like SIGSGEV/NZEC to be added soon
# clear err.txt file (this stores any error message that occurs while compiling/running)
echo -n > err.txt

#finding the extension of file
if [ $# -lt 2 ]
then 
    echo "Too few arguments "
    exit 2
else
    # split using '.' delimiter
    trail=$(echo $1 | cut -d "." -f 2)
fi

timeAllowed=$2

#we expect extension to be cpp/py only

# if file is cpp, we first  need to compile it
if [ $trail == cpp ]
then
    # disable all warnings so that stderr contains only error log
    compilation="g++ -w "
    # echo "cpp file"
elif [ $trail == py ]
then 
    compilation="python3 "
    # echo "Python file"
fi

# for cpp,python file, $compilation="g++ -w file.cpp","python3 file.py"
compilation+=$1

if [ $trail == cpp ]
then 
    # if a cpp file, we run to make object file (a.out) redirecting stderr to err.txt
    $compilation 2>err.txt
    # if err.txt contains something, compilation error came
    if [ $(wc -c < err.txt) -gt 0 ]
    then 
        # echo "Compilation error"
        echo 2 > temp_res.txt
        exit 1
    fi
    compilation="./a.out "
fi

# we are running compilation command 
# $compilation

# select all txt files in test directory
path="test/*.txt"
for file_path in $path
do 
    # extract the acutal file name (to be used when comparing outputs)
    file=$(echo $file_path | cut -d "/" -f 2)
    # pass testcase using io redirection to $compilation and redirect the output to temp_res.txt

    # use timeout command to make sure the code exits before the allowed time
    timeout $timeAllowed $compilation < $file_path > temp_res.txt

    # timelimit section
    # echo $? : Don't un-comment this as then $? contains exit code of 'echo' command which is 0 !
    # now $? contains exit code of timeout command which is non-zero if it killed the other command
    if [ $? -gt 0 ]
    then    
        echo 3 > temp_res.txt
        echo "TLE"
        exit 1
    fi
    # echo $?
    
    # compare the contents of temp_res.txt and our answer and store number of different lines in $tempRes
    tempRes=$(diff -y -i -w -B --suppress-common-lines temp_res.txt "solution/$file" | wc)
    # echo $tempRes
    tempRes=$(echo $tempRes | cut -f3 -d" ")
    # echo $tempRes

    # If there is some difference between the output expected and output produced by the submitted code
    if [ $tempRes -gt 0 ]
    then
        echo 1 > temp_res.txt
        exit 1
    fi
done

# temp_res.txt stores the exit code of our shell script
# In case everything went well
echo 0 > temp_res.txt
exit 0
