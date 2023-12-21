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
template: 
`
<div class="date-container" @keydown.up.prevent @keydown.down.prevent 
  @keyup.escape="escapePressed" @click.stop 
   v-click-outside="away">
   <input class="form-control" type="text" :name="name" :value="foo" 
      style="display:none;">

      <button class="pos-rel form-control left hand" style="height:40px;"
        :name="name" :value="value" 
         @input="updateDate($event.target.value)"  @click="open">
         <span>
               <i data-feather='calendar'  class='icon-inside hand'></i>
            </span>
         {{foo}}
      </button>

  <input type="text" v-model="selectedDate" readonly style="display:none;">
  <div v-show="show" role="dialog" aria-model="true"  class="date-flyout fade-in" tabindex="-1"   
    @keydown="handleKeyDown" ref="datepicker">
  <focus-trap :active="show">
    <div class="date-buttons-container">
      
        <button class="date-button rm-btn-styles" @click="showPreviousMonth" 
        tabindex="0" @keydown.enter.prevent>
            <i data-feather="chevron-left"></i>
        </button>
        <button class="year-box rm-btn-styles">
         {{ getMonthName(currentMonth) }} {{ currentYear }}</button>
        <button class="date-button rm-btn-styles" @click="showNextMonth" 
         tabindex="0" @keydown.enter.prevent>
            <i data-feather="chevron-right"></i>
         </button>
   </div>
   <div class="date-holder">
     <div class="date-days">
       <div class="cal-no-hover cal-day">Su</div>
       <div class="cal-no-hover cal-day">Mo</div>
       <div class="cal-no-hover cal-day">Tu</div>
       <div class="cal-no-hover cal-day">We</div>
       <div class="cal-no-hover cal-day">Th</div>
       <div class="cal-no-hover cal-day">Fr</div>
       <div class="cal-no-hover cal-day">Sa</div>
     </div>
      <div v-for="(row, rowIndex) in calendar" :key="rowIndex">
        <button v-for="(cell, cellIndex) in row" :key="cell.date"
            @click="selectDate(cell)"
            class="rm-btn-styles pull-left cal cal-day"
            :class="{ 'current-date': isCurrentDate(cell), 
              focused: isFocused(rowIndex, cellIndex) }"
            tabindex="-1"
            @focus="setFocus(rowIndex, cellIndex)"
        >{{ cell.date }}
      </div>
      </button>
   </div>   

    </focus-trap>
  </div>
</div>

`,
data: function () {
      return {
         show: false,
         today: new Date(),
         currentMonth: 0,
         currentYear: 0,
         selectedDate: '',
         foo: this.value,
         focusedRow: -1,
         focusedCell: -1,
      }
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
                     date: ''
                  });
               } else if (date > totalDays) {
                  break;
               } else {
                  row.push({
                     date: date,
                     month: this.currentMonth,
                     year: this.currentYear
                  });
                  date++;
               }
            }
            calendar.push(row);
         }
         return calendar;
      }
   },
   mounted() {
      this.currentMonth = this.today.getMonth();
      this.currentYear = this.today.getFullYear();
      this.selectedDate = this.today;
   },
   methods: {
      updateDate(newValue)
        {
          this.$emit('input',newValue);
          //this.show = false;
        },

      open() {
         this.show = !this.show;
         this.$nextTick(() => {
            this.$refs.datepicker.focus();
         });
      },
      away() {
         this.show = false;
      },
      escapePressed() {
         this.show = false;
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
      showPreviousMonth() {
         this.currentMonth--;
         if (this.currentMonth < 0) {
            this.currentMonth = 11;
            this.currentYear--;
         }
      },
      showNextMonth() {
         this.currentMonth++;
         if (this.currentMonth > 11) {
            this.currentMonth = 0;
            this.currentYear++;
         }
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
   }
});
