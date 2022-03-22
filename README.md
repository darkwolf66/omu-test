
## API Calls
```
/weather/{city}/{date?}/{update?}
```
Examples:
```
/weather/new_york
/weather/new_york/2022-03-22
/weather/new_york/2022-03-22/update
```
### Required Env
```
OPENWEATHERMAP_TOKEN="SECRET KEY"
OPENWEATHERMAP_URL="https://api.openweathermap.org/data/2.5"
```

##### Job Scheduled for 4 times a day on App\Console\Kernel
Done with everySixHours() but there is also the option to set 4 times a day with 
set hours to run with dailyAt('12:00')

#### Unit testing
For unit testing I didn't had much to test, so I created a helper to print standardized answers
and tested it
I didn't got thought implementation tests, let me know if that's needed and a can show it.
