##
# APP SETUP SCRIP
##

# SETUP BRANCH AND GET THE LATEST ODE
git checkout -b install

echo "GETTING THE LASTEST SETUP CODE"
git pull origin install

# REMOVE .git SO THAT WE NEVER PUSH MISTAKENLY
rm -rf .git

# CREATE APP DIRECTORY AND NAV TO IT
mkdir code
cd code || { echo "Failed"; exit 1; }


# INIT git
git init
git remote add origin https://github.com/scshasha/sfauthapp.git
git checkout -b development

echo "GETTING LATEST DEVELOPMENT CODE"
git pull origin development

echo "INSTALL DEPENDENCIES"
composer install

echo "CREATE AND UPDATE .env FILE"
#cp .env-sample .env

cd ../

cp .env-sample .env

# SPIN UP CONTAINERS
echo "SPINING UP DOCKER CONTAINERS"
docker-compose build
docker-compose up -d

echo "TODO:"

echo "Complete the database configs and creation..."
