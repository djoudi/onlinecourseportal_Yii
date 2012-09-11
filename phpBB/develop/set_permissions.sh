<<<<<<< HEAD
#!/bin/sh
# set permissions required for installation

dir=$(dirname $0)

for file in cache files store config.php images/avatars/upload
do
	chmod a+w $dir/../$file
done
=======
#!/bin/sh
# set permissions required for installation

dir=$(dirname $0)

for file in cache files store config.php images/avatars/upload
do
	chmod a+w $dir/../$file
done
>>>>>>> refs/remotes/origin/master
