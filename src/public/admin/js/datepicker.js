/*
|---------------------------------------------------------------
| Datepicker component 
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
|
|
*/
Vue.component('datepicker', {
props:['value','name'],
template: `
<div v-on:keyup.escape="escapePressed" class="date-container" @click.stop v-click-outside="away">
      <input class="form-control"  style="display:none;"
            :name="name" 
            :value="message" 
            />

      <label for="date">{{name}}</label>
      <br>
      <div class="form-control left" style="width:330px; height:40px; " :name="name" :value="value" 
         @input="updateDate($event.target.value)"  v-on:click="show =!show">
         {{message}}
      </div>
      <div class="date-flyout drop-shadow fade-in" v-show="show" >
        <div class="date-buttons-container">
            <button type="button" class="date-button rm-btn-styles" @click="previous()">
                <i data-feather="chevron-left"></i>
            </button>
            <button type="button" v-on:click="dateDays = !dateDays" class="year-box rm-btn-styles">
            {{months[currentMonth]}} {{currentYear}}
            </button>
            <button type="button" class="date-button rm-btn-styles" @click="next()">
                <i data-feather="chevron-right"></i>
            </button>
            
        </div>
        <div class="date-holder" v-show="dateDays">
            <div class="date-days">
                <div class="cal-no-hover cal-day">Sun</div>
                <div class="cal-no-hover cal-day">Mon</div>
                <div class="cal-no-hover cal-day">Tue</div>
                <div class="cal-no-hover cal-day">Wed</div>
                <div class="cal-no-hover cal-day">Thu</div>
                <div class="cal-no-hover cal-day">Fri</div>
                <div class="cal-no-hover cal-day">Sat</div>
            </div>
            <div v-for="i in this.arr" @click="getIndex(i)" >
                <div v-if="i.type == 'tr'" class="clearfix">
                </div>
                <div v-else-if="i.value == ''" class="cal-no-hover cal-day">
                </div>
                <button type="button" v-else class="rm-btn-styles pull-left cal cal-day"> 
                    {{i.value}} 
                </button>
            </div>
            
        </div>
        <div class="date-years" v-if="!dateDays">
            <div class="date-today">
                <button type="button" class="rm-btn-styles" v-on:click="getToday">Today</button>
            </div>
            <div class="date-chunk" v-for="year in years">
                <button type="button" v-on:click="set_year(year)" class="rm-btn-styles date-years-row">{{year}}</button>
            </div>
            
        </div>
    </div>
</div>
    `,
    data: function () {

        return {
            message: this.value,
            today: new Date(),
            currentMonth: new Date().getMonth(),
            currentYear: new Date().getFullYear(),
            months: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            days: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            arr: [],
            show: false,
            dateDays: true,
            years: [1900, 1901, 1902, 1903, 1904, 1905, 1906, 1907, 1908,
                1909, 1910, 1911, 1912, 1913, 1914, 1915, 1916, 1917, 1918,
                1919, 1920, 1921, 1922, 1923, 1924, 1925, 1926, 1927, 1928,
                1929, 1930, 1931, 1932, 1933, 1934, 1935, 1936, 1937, 1938,
                1939, 1940, 1941, 1942, 1943, 1944, 1945, 1946, 1947, 1948,
                1949, 1950, 1951, 1952, 1953, 1954, 1955, 1956, 1957, 1958,
                1959, 1960, 1961, 1962, 1963, 1964, 1965, 1966, 1967, 1968,
                1969, 1970, 1971, 1972, 1973, 1974, 1975, 1976, 1977, 1978,
                1979, 1980, 1981, 1982, 1983, 1984, 1985, 1986, 1987, 1988,
                1989, 1990, 1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998,
                1999, 2000, 2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008,
                2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018,
                2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029,
                2030, 2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040,
                2041, 2042, 2043, 2044, 2045, 2046, 2047, 2048, 2049, 2050, 2051,
                2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061, 2062,
                2063, 2064, 2065, 2066, 2067, 2068, 2069, 2070, 2071, 2072, 2073,
                2074, 2075, 2076, 2077, 2078, 2079, 2080, 2081, 2082, 2083, 2084,
                2085, 2086, 2087, 2088, 2089, 2090, 2091, 2092, 2093, 2094, 2095,
                2096, 2097, 2098, 2099, 2100
            ]
        }
    },
    created() {
        this.showCalendar(this.currentMonth, this.currentYear)
    },
    methods: {
        away: function () {
            this.show = false;
        },
        escapePressed(){
            this.show = false;
        },
        updateDate(newValue)
        {
          this.$emit('input',newValue);
        },
        set_year(year) {
            this.dateDays = true;
            this.currentYear = year;
            this.showCalendar(this.currentMonth, this.currentYear);
        },
        getIndex(str) {
            //This is where the full datestamp
            //comes from
            this.updateDate(str.stamp);
            this.message = str.stamp
        },
        next() {
            this.currentYear = (this.currentMonth === 11) ? this.currentYear + 1 : this.currentYear;
            this.currentMonth = (this.currentMonth + 1) % 12;
            this.showCalendar(this.currentMonth, this.currentYear);
        },

        previous() {
            this.currentYear = (this.currentMonth === 0) ? this.currentYear - 1 : this.currentYear;
            this.currentMonth = (this.currentMonth === 0) ? 11 : this.currentMonth - 1;
            this.showCalendar(this.currentMonth, this.currentYear);
        },

        getToday()
        {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            this.message = today;

            this.currentMonth = new Date().getMonth(); 
            this.set_year(yyyy);
        },

        showCalendar(month, year) {

            //testing reset array
            this.arr = [];

            let firstDay = (new Date(year, month)).getDay();
            let daysInMonth = 32 - new Date(year, month, 32).getDate();

            // creating all cells
            let date = 1;
            for (let i = 0; i < 6; i++) {

                //creating individual cells, filing them up with data.
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        //testing
                        let obj = {
                            type: "td",
                            value: "",
                            stamp: ""
                        };
                        this.arr.push(obj);
                    } else if (date > daysInMonth) {
                        break;
                    } else {
                        if (date === this.today.getDate() &&
                            year === this.today.getFullYear() &&
                            month === this.today.getMonth()
                        ) {
                            // cell.classList.add("bg-today");
                        } // color today's date

                        //don't forget to add one to the month!
                        let newMonth = month + 1;

                        //Simple date conversion to make it valid eg 2022-04-04
                        if (newMonth.toString().length < 2) {
                            aa = '0' + newMonth;
                        } else {
                            aa = newMonth.toString();
                        }
                        if (date.toString().length < 2) {
                            bb = '0' + date.toString();
                        } else {
                            bb = date.toString();
                        }

                        // Basic usage of dateFormat refer to documentation
                        let tmpStamp = year + "-" + aa + "-" + bb;

                        //bind to v-model

                        let obj = {
                            type: "td",
                            value: date,
                            stamp: tmpStamp
                        };
                        this.arr.push(obj);

                        date++;
                    }
                }

                let obj = {
                    type: "tr",
                    value: "",
                    stamp: ""
                };
                this.arr.push(obj);
            }
        }
    }
});
