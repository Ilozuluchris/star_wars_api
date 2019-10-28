#star_wars_api


## Setup
- Ensure you have docker locally then run `docker build . -t ilozulu_chris_sw_api`
- Run `docker volume create --name=star_wars_api_data; docker volume create --name=redis_data`

## Usage
   ### Locally
   - After setting up run `docker-compose up -d`
   - Visit [Local Documentation](localhost:8081/api/documentation) to see how to make to queries
   
   ### Remote
   - Project is also hosted [Documentation](http://chris-starwars-api.herokuapp.com/api/documentation) 
   to see how to make queries.


##Testing
- After setting up, run tests with `docker run -i --entrypoint='/bin/bash'  ilozulu_chris_sw_api  -c 'vendor/bin/phpunit'`