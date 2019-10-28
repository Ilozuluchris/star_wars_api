#star_wars_api


## Setup
- Ensure you have docker locally then run `docker build . -t ilozulu_chris_sw_api`
- Delete docker volumes if any to prevent problems `docker volume rm star_wars_api_data; docker volume rm cache_data`
- Run `docker volume create --name=star_wars_api_data; docker volume create --name=cache_data`

## Usage
   ### Locally
   - After setting up run `docker-compose up -d`
   - Visit [Local Documentation](localhost:8081/api/documentation) to see how to make to queries
   
   ### Remote
   - Project is also hosted [Documentation](http://chris-starwars-api.herokuapp.com/api/documentation) 
   to see how to make queries.


##Testing
- After setting up, run tests with coverage using  `docker-compose up -d --build && docker-compose exec api  bash -c 'vendor/bin/phpunit --coverage-text=coverage.txt && head -n 10 coverage.txt'`