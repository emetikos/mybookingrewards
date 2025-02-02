<div>
    <div x-data="app" x-cloak>


        <div class="relative" @keydown.escape="closeDatepicker()" @click.outside="closeDatepicker()">
            <div class="w-full inline-flex items-center">
                <input type="text"
                       @click="endToShow = 'from'; init(); showDatepicker = true"
{{--                       x-model="chosenDate"--}}
                       wire:model="chosenDate"
                       class="w-full rounded-md bg-white outline-1 outline-gray-300  py-1.5 pr-8 pl-3 text-gray-900"/>

            </div>
            <div
                class="bg-white mt-2 rounded-lg shadow p-4 absolute"
                style="width: 17rem"
                x-show="showDatepicker"
                x-transition
            >
                <div class="flex flex-col items-center">

                    <div class="w-full flex justify-between items-center mb-2">
                        <div>
                            <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                            <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                        </div>
                        <div>
                            <button
                                type="button"
                                class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                @click="if (month == 0) {year--; month=11;} else {month--;} getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button
                                type="button"
                                class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                @click="if (month == 11) {year++; month=0;} else {month++;}; getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="w-full flex flex-wrap mb-3 -mx-1">
{{--                        <template x-for="(day, index) in DAYS" :key="index">--}}
{{--                            <div style="width: 14.26%" class="px-1">--}}
{{--                                <div--}}
{{--                                    x-text="day"--}}
{{--                                    class="text-gray-800 font-medium text-center text-xs"--}}
{{--                                ></div>--}}
{{--                            </div>--}}
{{--                        </template>--}}
                    </div>

                    <div class="flex flex-wrap -mx-1">
{{--                        <template x-for="blankday in blankdays">--}}
{{--                            <div--}}
{{--                                style="width: 14.28%"--}}
{{--                                class="text-center border p-1 border-transparent text-sm"--}}
{{--                            ></div>--}}
{{--                        </template>--}}
                        <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                            <div style="width: 14.28%">
                                <div
                                    @click="getDateValue(date, false)"
                                    @mouseover="getDateValue(date, true)"
                                    x-text="date"
                                    class="p-1 cursor-pointer text-center text-sm leading-none leading-loose transition ease-in-out duration-100"
                                    :class="{'font-bold': isToday(date) == true, 'bg-blue-800 text-white rounded-l-full': isDateFrom(date) == true, 'bg-blue-800 text-white rounded-r-full': isDateTo(date) == true, 'bg-blue-200': isInRange(date) == true }"
                                ></div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                showDatepicker: false,
                dateFromYmd: '',
                dateToYmd: '',
                chosenDate: '',
                outputDateFromValue: '',
                outputDateToValue: '',
                dateFromValue: '',
                dateToValue: '',
                currentDate: null,
                dateFrom: null,
                dateTo: null,
                endToShow: '',
                selecting: false,
                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],

                convertFromYmd(dateYmd) {
                    const year = Number(dateYmd.substr(0, 4));
                    const month = Number(dateYmd.substr(5, 2)) - 1;
                    const date = Number(dateYmd.substr(8, 2));

                    return new Date(year, month, date);
                },

                convertToYmd(dateObject) {
                    const year = dateObject.getFullYear();
                    const month = dateObject.getMonth() + 1;
                    const date = dateObject.getDate();

                    return ('0' + month).slice(-2) + "-" +  ('0' + date).slice(-2) + year;
                },

                init() {
                    this.selecting = ( this.endToShow === 'to' && this.dateTo ) || ( this.endToShow === 'from' && this.dateFrom);
                    if ( ! this.dateFrom ) {
                        if ( this.dateFromYmd ) {
                            this.dateFrom = this.convertFromYmd( this.dateFromYmd );
                        }
                    }
                    if ( ! this.dateTo ) {
                        if ( this.dateToYmd ) {
                            this.dateTo = this.convertFromYmd( this.dateToYmd );
                        }
                    }
                    if ( ! this.dateFrom ) {
                        this.dateFrom = this.dateTo;
                    }
                    if ( ! this.dateTo ) {
                        this.dateTo = this.dateFrom;
                    }
                    if ( this.endToShow === 'from' && this.dateFrom ) {
                        this.currentDate = this.dateFrom;
                    } else if ( this.endToShow === 'to' && this.dateTo ) {
                        this.currentDate = this.dateTo;
                    } else {
                        this.currentDate = new Date();
                    }
                    currentMonth = this.currentDate.getMonth();
                    currentYear = this.currentDate.getFullYear();
                    if ( this.month !== currentMonth || this.year !== currentYear ) {
                        this.month = currentMonth;
                        this.year = currentYear;
                        this.getNoOfDays();
                    }
                    this.setDateValues();
                },

                isToday(date) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, date);

                    return today.toDateString() === d.toDateString();
                },

                isDateFrom(date) {
                    const d = new Date(this.year, this.month, date);

                    if ( !this.dateFrom ) {
                        return false;
                    }

                    return d.getTime() === this.dateFrom.getTime();
                },

                isDateTo(date) {
                    const d = new Date(this.year, this.month, date);

                    if ( !this.dateTo ) {
                        return false;
                    }

                    return d.getTime() === this.dateTo.getTime();
                },

                isInRange(date) {
                    const d = new Date(this.year, this.month, date);

                    return d > this.dateFrom && d < this.dateTo;
                },

                outputDateValues() {
                    if (this.dateFrom) {
                        this.outputDateFromValue = this.dateFrom.toDateString();
                        // this.dateFromYmd = this.convertToYmd(this.dateFrom);
                    }
                    if (this.dateTo) {
                        this.outputDateToValue = this.dateTo.toDateString();
                        // this.dateToYmd = this.convertToYmd(this.dateTo);
                    }

                    if (this.dateFrom && this.dateTo) {
                        let options = { day: '2-digit', month: 'short', year: 'numeric' };
                        this.chosenDate = this.dateFrom.toLocaleDateString('en-GB', options) + ' to ' + this.dateTo.toLocaleDateString('en-GB', options);
                    }

                },

                setDateValues() {
                    if (this.dateFrom) {
                        this.dateFromValue = this.dateFrom.toDateString();
                    }
                    if (this.dateTo) {
                        this.dateToValue = this.dateTo.toDateString();
                    }
                },

                getDateValue(date, temp) {
                    // if we are in mouse over mode but have not started selecting a range, there is nothing more to do.
                    if (temp && !this.selecting) {
                        return;
                    }
                    let selectedDate = new Date(this.year, this.month, date);
                    if ( this.endToShow === 'from' ) {
                        this.dateFrom = selectedDate;
                        if ( ! this.dateTo ) {
                            this.dateTo = selectedDate;
                        } else if ( selectedDate > this.dateTo ) {
                            this.endToShow = 'to';
                            this.dateFrom = this.dateTo;
                            this.dateTo = selectedDate;
                        }
                    } else if ( this.endToShow === 'to' ) {
                        this.dateTo = selectedDate;
                        if ( ! this.dateFrom ) {
                            this.dateFrom = selectedDate;
                        } else if ( selectedDate < this.dateFrom ) {
                            this.endToShow = 'from';
                            this.dateTo = this.dateFrom;
                            this.dateFrom = selectedDate;
                        }
                    }
                    this.setDateValues();

                    if (!temp) {
                        if (this.selecting) {
                            this.outputDateValues();
                            this.closeDatepicker();
                        }
                        this.selecting = !this.selecting;
                    }
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay();
                    let blankdaysArray = [];
                    for ( var i=1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }

                    let daysArray = [];
                    for ( var i=1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }

                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                },

                closeDatepicker() {
                    this.endToShow = '';
                    this.showDatepicker = false;
                }
            }))
        })
    </script>
</div>
