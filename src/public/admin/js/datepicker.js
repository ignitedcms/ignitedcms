/*
|---------------------------------------------------------------
| Datepicker component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('datepicker', {
  props: ['value', 'name'],
  template: `
  <div class="date-container"
      @keydown.up.prevent
      @keydown.down.prevent
      @keyup.escape="escapePressed"
      v-click-outside="away"
    >
      <input
        class="form-control"
        type="text"
        :name="name"
        :value="foo"
        style="display:none;"
      >

      <button
        class="pos-rel form-control left hand"
        style="height:40px;"
        aria-haspopup="dialog"
        :aria-expanded="arr"
        :aria-controls="'datepicker-'+ uniqueId"
        :name="name"
        :value="value"
        @input="updateDate($event.target.value)"
        @click="open"
        @click.prevent
      >
        <span>
          <i data-feather='calendar' class='icon-inside hand'></i>
        </span>
        {{foo}}

        <input
          type="text"
          v-model="selectedDate"
          readonly
          style="display:none;"
        >

        <div
          v-show="show"
          :id="'datepicker-'+ uniqueId"
          role="dialog"
          style="position:absolute; top:35px; left:0;"
          class="date-flyout drop-shadow fade-in"
          tabindex="-1"
          @click.stop
          @keydown="handleKeyDown"
        >
          <focus-trap :active="show">
            <div class="date-buttons-container">
              <button
                class="date-button rm-btn-styles"
                aria-label="previous month"
                @click="showPreviousMonth"
                @focus="focusPreviousMonth"
                tabindex="0"
                @click.prevent
              >
                <i data-feather="chevron-left"></i>
              </button>
              <button
                class="year-box rm-btn-styles"
                @click.prevent
              >
                {{ getMonthName(currentMonth) }} {{ currentYear }}
              </button>
              <button
                class="date-button rm-btn-styles"
                aria-label="next month"
                @click="showNextMonth"
                @focus="focusNextMonth"
                tabindex="0"
                @click.prevent
              >
                <i data-feather="chevron-right"></i>
              </button>
            </div>
            <div class="date-holder rm-btn-styles">
              <div class="date-days">
                <div class="cal-no-hover cal-day">Su</div>
                <div class="cal-no-hover cal-day">Mo</div>
                <div class="cal-no-hover cal-day">Tu</div>
                <div class="cal-no-hover cal-day">We</div>
                <div class="cal-no-hover cal-day">Th</div>
                <div class="cal-no-hover cal-day">Fr</div>
                <div class="cal-no-hover cal-day">Sa</div>
              </div>
              <button
                class="rm-btn-styles"
                style="width:100%;"
                @focus="calendarFocused"
                ref="datepicker"
                @click.prevent
              >
                <div v-for="(row, rowIndex) in calendar" :key="rowIndex">
                  <button
                    v-for="(cell, cellIndex) in row"
                    :key="cell.date"
                    @click="selectDate(cell)"
                    class="rm-btn-styles pull-left cal cal-day"
                    :class="{
                      'current-date': isCurrentDate(cell),
                      focused: isFocused(rowIndex, cellIndex)
                    }"
                    tabindex="-1"
                    @focus="setFocus(rowIndex, cellIndex)"
                    @click.prevent
                  >
                    {{ cell.date }}
                  </button>
                </div>
              </button>
            </div>
          </focus-trap>
        </div>
      </button>
    </div>
  `,
  data() {
    return {
      show: false,
      today: new Date(),
      currentMonth: 0,
      currentYear: 0,
      selectedDate: '',
      foo: this.value,
      focusedRow: -1,
      focusedCell: -1,
      enableArrowkeys: false,
      arr: 'false',
      uniqueId: Math.random().toString(36).substring(2) // Generate a unique ID

    };
  },
  computed: {
    weekdays() {
      return ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
    },
    calendar() {
      const firstDay = new Date(this.currentYear, this.currentMonth, 1);
      const startingDay = firstDay.getDay();
      const totalDays = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
      let date = 1;
      const calendar = [];
      for (let i = 0; i < 6; i++) {
        const row = [];
        for (let j = 0; j < 7; j++) {
          if (i === 0 && j < startingDay) {
            row.push({
              date: '',
            });
          } else if (date > totalDays) {
            break;
          } else {
            row.push({
              date: date,
              month: this.currentMonth,
              year: this.currentYear,
            });
            date++;
          }
        }
        calendar.push(row);
      }
      return calendar;
    },
  },
  mounted() {
    this.currentMonth = this.today.getMonth();
    this.currentYear = this.today.getFullYear();
    this.selectedDate = this.today;

    feather.replace();

  },
  methods: {
    updateDate(newValue) {
      this.$emit('input', newValue);
    },
    calendarFocused(event)
    {
      this.enableArrowkeys = true;
      //event.target.blur(); // Remove focus from the button
    },
    focusPreviousMonth(){
      this.enableArrowkeys = false;
    },
    focusNextMonth(){
      this.enableArrowkeys = false;
    },
    open() {
      this.show = !this.show;
      if(this.show == true) {
         this.arr = 'true';
      }
      else {
         this.arr = 'false';
      }
      this.$nextTick(() => {
        this.$refs.datepicker.focus();
      });
    },
    away() {
      this.show = false;
      this.arr = 'false';
    },
    escapePressed() {
      this.show = false;
      this.arr = 'false';
    },
    formatDate(date) {
      var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
      if (month.length < 2)
        month = '0' + month;
      if (day.length < 2)
        day = '0' + day;
      return (year.toString() + "-" + month.toString() + "-" + day.toString());
    },
    showPreviousMonth(cell) {
      this.currentMonth--;
      if (this.currentMonth < 0) {
        this.currentMonth = 11;
        this.currentYear--;
      }

      //Final focus UX tweaks
      //When tabbing
      const b = new Date(this.currentYear, this.currentMonth, 1);
      this.selectedDate = b;
      this.focusOnSelectedDate(b);

    },
    showNextMonth() {
      this.currentMonth++;
      if (this.currentMonth > 11) {
        this.currentMonth = 0;
        this.currentYear++;
      }

      //Final focus UX tweaks
      //When tabbing
      const b = new Date(this.currentYear, this.currentMonth, 1);
      this.selectedDate = b;
      this.focusOnSelectedDate(b);
    },
    getMonthName(monthIndex) {
      const months = ['January', 'February', 'March', 'April', 'May',
        'June', 'July', 'August', 'September', 'October', 'November', 'December'
      ];
      return months[monthIndex];
    },
    selectDate(cell) {
      if (cell.date == '') {
        //empty nothing to do
      } else {
        const selectedDate = new Date(cell.year, cell.month, cell.date);
        this.selectedDate = selectedDate;
        this.moveFocus(0, 0);
        this.$refs.datepicker.focus();
        this.foo = this.formatDate(selectedDate);
        this.updateDate(this.foo);
      }
    },
    isCurrentDate(cell) {
      return cell.date === this.today.getDate() &&
        cell.month === this.today.getMonth() &&
        cell.year === this.today.getFullYear();
    },
    handleKeyDown(event) {
       if(this.enableArrowkeys) {
            if (event.key === 'ArrowLeft') {
              this.moveFocus(0, -1);
            } else if (event.key === 'ArrowRight') {
              this.moveFocus(0, 1);
            } else if (event.key === 'ArrowUp') {
              this.moveFocus(-1, 0);
            } else if (event.key === 'ArrowDown') {
              this.moveFocus(1, 0);
            } else if (event.key === 'Enter') {
              this.foo = this.formatDate(this.selectedDate);
              this.updateDate(this.foo);
            }
       }
    },
    moveFocus(rowChange, colChange) {
      let date = new Date(this.selectedDate);
      date.setDate(date.getDate() + (rowChange * 7) + colChange);
      if (date.getMonth() !== this.currentMonth) {
        this.currentMonth = date.getMonth();
        this.currentYear = date.getFullYear();
      }
      this.selectedDate = date;
      this.focusOnSelectedDate();
    },
    isFocused(rowIndex, cellIndex) {
      return rowIndex === this.focusedRow && cellIndex === this.focusedCell;
    },
    setFocus(rowIndex, cellIndex) {
      this.focusedRow = rowIndex;
      this.focusedCell = cellIndex;
      this.focusOnSelectedDate();
    },
    focusOnSelectedDate() {
      const date = new Date(this.selectedDate);
      const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
      const startingDay = firstDay.getDay();
      const selectedCell = date.getDate() + startingDay - 1;
      this.focusedRow = Math.floor(selectedCell / 7);
      this.focusedCell = selectedCell % 7;
    },
  },
});
