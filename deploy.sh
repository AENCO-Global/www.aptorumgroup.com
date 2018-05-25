#!/bin/bash
echo "This script doesnt work yet, the site is ftp to godaddy"

# echo "--=== Incoming Paramters (This script hould be reusable) ===--"
# echo "[P1] Version Number is :$1 "
# echo "[P2] Target Server is :$2 "
# echo "[P3] Target Folder is :$3 "
# echo "---------------------------------------"

# echo "--=== Identify the taret server ===--"
# ssh -p 22 $2 "sudo /home/ubuntu/role.sh"
# ssh -p 22 $2 "sudo whoami"
# echo "---------------------------------------"

# echo "--=== Run local Tests on Deployment ===--"
# echo "No tests yet Defined"
# echo "-----------------------------------------"

# echo "--=== Modify Version Information ===--"
# echo "Version $1" > version.html
# ls  -l
# echo "--------------------------------------"

# echo "--=== Transfer files to remote Server ===--"
# echo "rsync -avzhe ssh  --rsync-path="""rsync""" ./public_html/* jenkins@$2:$3"""
# rsync -avzhe ssh  --rsync-path="rsync" ./public_html/* jenkins@$2:$3
# echo "---------------------------------------"

# #echo "--=== Set permisions on transfered files ===--"
# #ssh -p 22 $2 "chown -R apache:apache $3"
# #echo "-------------------------------------------"

# echo "----====== Verify Deployments-List from Remote ======----"
# ssh -p 22 $2 "ls -al /home/apache/public_html/"
# ssh -p 22 $2 "ls -al $3"
# echo "---------------------------------------------------------"

# echo "--=== Version Deployed is [$1] The folowing output from version.info ===--"
# ssh -p 22 $2 "cat $3/version.html"
# echo "------------The-End-------------------------------------------------------"