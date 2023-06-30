An E-commerce Website Develop on Laravel Framework

Some Git Important Tips

1-How to Config Git
  ->git config --global user.name "Your Name"
  ->git config --global user.password "Your Email Address"

2-How Initialize SSH key configuration
  
  ->ssh -keygen -t rsa -b 4096 -C "Your Email Address of Git"
  ->eval $(ssh-agent -s)
  ->ssh-add ~/.ssh/id_rsa
  ->tail ~/.ssh/id_rsa.pub

3-How Make Branch in Git

  ->git checkout -b <Branch Name>
  ->git add .
  ->git commit -m "Message"
  ->git checkout <Branch Name> (to switch on another branch)
  ->git branch (to know all branches)
  ->git merge <Branch Name> (command to merge branch in master branch all their changes in code)
  ->git push origin <Branch Name> (push your branch on remote branch)
  ->git push -d origin <Branch Name> (delete your branch from remote)
  ->git branch --merged (show already merged branches)
  ->git branch --no-merged (show not merged branches)
  ->git branch -d <Branch Name> (delete your branch and got error if not merged)
  ->git branch  -D <Branch Name> (delete your branch without merged )

4- How Push Your Project on Remote

 ->git status
 ->git init
 ->git add .
 ->git commit -m "Initial commit"
 ->git remote add origin <your repository url>
 ->git push -u origin master

5- Collabration with Team (To contribute thier Code in Your Project)

 ->Your Team login with their github account
 ->Search your repositories on thier Account
 ->click on repository
 ->Fork the target repository
 ->clone the repo in your local machine in a Folder
 ->run npm install command
 ->git checkout -b <branch Name> (make a branch with specified name which code you want to write     ex-Checkout-page)

 ->git add .
 ->git commit -m "Making Checkout pages"
 ->git push origin <branch Name> (Push your branch in your own Fork)
 ->create a PR(pull request): go to your fork repo and choose (Compare and Pull Request),open Pull Request and reviews

 ->now author open his GitHub account and see your pull request and merge it his in code by opening thier project in editor and write command ->git pull origin master