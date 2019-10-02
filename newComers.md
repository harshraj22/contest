# Branch Policy :
* develop All development goes on in this branch. If you're making a contribution, you are supposed to make a pull request to develop.
* master This contains the stable code. After significant features/bugfixes are accumulated on development, we move it to master.

# Set up the project :
* Fork the current repo to your remote system 
    - This is called your remote branch.
* Clone the forked repo to your local machine ```https://github.com/<your user name>/contest.git```
    - This is your local branch.
* run ```git remote add upstream https://github.com/harshraj22/contest.git``` . 
    - This sets default remote feature tracking branch for the current branch. Any git pull will bring commits from remote develop branch and merge to current switched branch. confirm using ```git remote -v ``` .
    - ```git fetch --all ```  to fetch everything from remote clone.
* Checkout to local develop branch and set remote develop branch as tracking ```git checkout develop  ```.
* Now all pr branches are checked out from this develop branch.
### Don't like vim ?
* Set default editor for git repoo to sublime ```git config --global core.editor "subl -n -w"``` or to vs code ```git config --global core.editor "code --wait"```

<br>

# Got assigned to some issue ?
* Checkout to a new branch ```git checkout -b <your branch name> ``` . Try to make branch name meaningful.
* Make asked changes.
* Add changes to staging area ```git add <path of modified file> ```
* Commit changes ```git commit -m "<your commit message>"```. Make commit message simple and meaningful. 
    - You accidently made wrong commit message ?
    use ```git commit --amend -m "<new commit message>"``` and add a -f flag while pushing.
* Ready to push changes ? Wait ! Pull changes before pushing ``` git pull --rebase origin develop``` . This syncs your local develop branch .
* Remember your branch is still local, push to remote repo using ```git push -u origin <your branch name>``` . 
* Make the pull request. First comparing through forks, and then through branches to make sure you are making a pr from across desired branches. Make PR only on develop branch.
### They asked to modify it ?
* Add modifications.
* Add files to staging area and commit changes.
* Pull before pushing ```git pull --rebase origin develop ```
* Since the branch is now available remotely, push the changes directly ```git push```.
### What ? They want more changes with only one commit ?
* Make commits as required.
* Squash your commits . Do an interactive rebase and change ``` pick ``` to ``` squash ```.
### They also want to change the commit message of last x commits ?
* Do an interactive rebase ```git rebase -i HEAD~x ``` . Change ``` pick ``` to ```r``` for the commit you want the message to be changed.
* Another window opens up, update the commit message.
* Push using ```git push -f ```

### Got pr merged ?
* Congratulations. 
* Delete the branch locally and remotely.
* Checkout to develop ```git checkout develop ```. 
* Delete branch locally ``` git branch -D <branch to be deleted name> ```
* Delete the branch remotely ``` git push origin --delete <branch name> ```.


### Committed a file that you didn't want ?
* Do a head reset ``` git reset HEAD~ ```. This unstages the files.

### Now you want to discard all changes you made in this branch ?
``` git reset --hard HEAD ``` and ``` git clean -n ``` to see what would be removed, then ```git clean -fdx ```

<br>

## Want to review someone's pull request ?
* Checkout to pr branch by ``` git fetch origin pull/<ID>/head:<BRANCHNAME> ``` . ID is the pull request id (headed by a # in pull request) and BRANCHNAME is some random name to newly created local branch.
* Check the changes, switch to develop, and delete the branch locally. Since you haven't pushed this new branch to remote, no need to try deleting it from remote.