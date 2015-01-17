#!/bin/bash

printf "Plugin name: "
read NAME

printf "Destination folder: "
read FOLDER

DEFAULT_NAME="CPT Master"
DEFAULT_CLASS=${DEFAULT_NAME// /_}
DEFAULT_TOKEN=$( tr '[A-Z]' '[a-z]' <<< $DEFAULT_CLASS)
DEFAULT_SLUG=${DEFAULT_TOKEN//_/-}

CLASS=${NAME// /_}
TOKEN=$( tr '[A-Z]' '[a-z]' <<< $CLASS)
SLUG=${TOKEN//_/-}

git clone git@github.com:tiredbug/$DEFAULT_SLUG.git $FOLDER/$SLUG

echo "Removing git files..."

mkdir -p $FOLDER
cd $FOLDER/$SLUG

rm -rf .git

echo "Updating plugin files..."

mv $DEFAULT_SLUG.php $SLUG.php

cp $SLUG.php $SLUG.tmp
sed "s/$DEFAULT_NAME/$NAME/g" $SLUG.tmp > $SLUG.php
rm $SLUG.tmp

cp $SLUG.php $SLUG.tmp
sed "s/$DEFAULT_SLUG/$SLUG/g" $SLUG.tmp > $SLUG.php
rm $SLUG.tmp

cp $SLUG.php $SLUG.tmp
sed "s/$DEFAULT_TOKEN/$TOKEN/g" $SLUG.tmp > $SLUG.php
rm $SLUG.tmp

cp $SLUG.php $SLUG.tmp
sed "s/$DEFAULT_CLASS/$CLASS/g" $SLUG.tmp > $SLUG.php
rm $SLUG.tmp

cd classes

mv class-$DEFAULT_SLUG-admin.php class-$SLUG-admin.php

cp class-$SLUG-admin.php class-$SLUG-admin.tmp
sed "s/$DEFAULT_CLASS/$CLASS/g" class-$SLUG-admin.tmp > class-$SLUG-admin.php
rm class-$SLUG-admin.tmp

cp class-$SLUG-admin.php class-$SLUG-admin.tmp
sed "s/$DEFAULT_TOKEN/$TOKEN/g" class-$SLUG-admin.tmp > class-$SLUG-admin.php
rm class-$SLUG-admin.tmp

cp class-$SLUG-admin.php class-$SLUG-admin.tmp
sed "s/$DEFAULT_SLUG/$SLUG/g" class-$SLUG-admin.tmp > class-$SLUG-admin.php
rm class-$SLUG-admin.tmp

mv class-$DEFAULT_SLUG-settings.php class-$SLUG-settings.php

cp class-$SLUG-settings.php class-$SLUG-settings.tmp
sed "s/$DEFAULT_CLASS/$CLASS/g" class-$SLUG-settings.tmp > class-$SLUG-settings.php
rm class-$SLUG-settings.tmp

cp class-$SLUG-settings.php class-$SLUG-settings.tmp
sed "s/$DEFAULT_TOKEN/$TOKEN/g" class-$SLUG-settings.tmp > class-$SLUG-settings.php
rm class-$SLUG-settings.tmp

cp class-$SLUG-settings.php class-$SLUG-settings.tmp
sed "s/$DEFAULT_SLUG/$SLUG/g" class-$SLUG-settings.tmp > class-$SLUG-settings.php
rm class-$SLUG-settings.tmp

mv class-$DEFAULT_SLUG-post-type.php class-$SLUG-post-type.php

cp class-$SLUG-post-type.php class-$SLUG-post-type.tmp
sed "s/$DEFAULT_CLASS/$CLASS/g" class-$SLUG-post-type.tmp > class-$SLUG-post-type.php
rm class-$SLUG-post-type.tmp

cp class-$SLUG-post-type.php class-$SLUG-post-type.tmp
sed "s/$DEFAULT_TOKEN/$TOKEN/g" class-$SLUG-post-type.tmp > class-$SLUG-post-type.php
rm class-$SLUG-post-type.tmp

cp class-$SLUG-post-type.php class-$SLUG-post-type.tmp
sed "s/$DEFAULT_SLUG/$SLUG/g" class-$SLUG-post-type.tmp > class-$SLUG-post-type.php
rm class-$SLUG-post-type.tmp

mv class-$DEFAULT_SLUG-taxonomy.php class-$SLUG-taxonomy.php

cp class-$SLUG-taxonomy.php class-$SLUG-taxonomy.tmp
sed "s/$DEFAULT_CLASS/$CLASS/g" class-$SLUG-taxonomy.tmp > class-$SLUG-taxonomy.php
rm class-$SLUG-taxonomy.tmp

cp class-$SLUG-taxonomy.php class-$SLUG-taxonomy.tmp
sed "s/$DEFAULT_TOKEN/$TOKEN/g" class-$SLUG-taxonomy.tmp > class-$SLUG-taxonomy.php
rm class-$SLUG-taxonomy.tmp

cp class-$SLUG-taxonomy.php class-$SLUG-taxonomy.tmp
sed "s/$DEFAULT_SLUG/$SLUG/g" class-$SLUG-taxonomy.tmp > class-$SLUG-taxonomy.php
rm class-$SLUG-taxonomy.tmp

echo "Complete!"
