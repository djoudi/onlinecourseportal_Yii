<<<<<<< HEAD
#!/bin/sh
DIR=$(dirname "$0")/../cache;
cat "$DIR/sql_*.php" | grep '/* SELECT' | sed 's,/\* ,,;s, \*/,,' | sort
=======
#!/bin/sh
DIR=$(dirname "$0")/../cache;
cat "$DIR/sql_*.php" | grep '/* SELECT' | sed 's,/\* ,,;s, \*/,,' | sort
>>>>>>> refs/remotes/origin/master
