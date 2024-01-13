<?php
/*
|---------------------------------------------------------------
| Calendar model
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Models\admin;

class Calendar
{
    private $year;

    private $month;

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function displayCalendar()
    {
        echo '<h2>'.date('F Y', mktime(0, 0, 0, $this->month, 1, $this->year)).'</h2>';
        echo "<table border='1'>";
        echo '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';

        $currentMonth = date('n');
        $currentYear = date('Y');
        $currentDay = date('j');

        $firstDay = mktime(0, 0, 0, $this->month, 1, $this->year);
        $lastDay = mktime(0, 0, 0, $this->month + 1, 0, $this->year);
        $daysInMonth = date('j', $lastDay);

        $dayOfWeek = date('w', $firstDay);
        echo '<tr>';
        for ($i = 0; $i < $dayOfWeek; $i++) {
            echo '<td></td>';
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            if ($dayOfWeek == 7) {
                echo '</tr><tr>';
                $dayOfWeek = 0;
            }

            // Check if the current day belongs to the current month and year
            $isCurrentMonth = ($this->month == $currentMonth && $this->year == $currentYear);
            $isCurrentDay = ($isCurrentMonth && $day == $currentDay);
            $fontWeight = $isCurrentDay ? 'font-weight: bold;' : '';
            echo "<td style='$fontWeight'>$day</td>";
            $dayOfWeek++;
        }

        echo '</tr></table>';
    }

    public function showPreviousMonth()
    {
        $this->month--;
        if ($this->month < 1) {
            $this->month = 12;
            $this->year--;
        }
        $this->displayCalendar();
    }

    public function showNextMonth()
    {
        $this->month++;
        if ($this->month > 12) {
            $this->month = 1;
            $this->year++;
        }
        $this->displayCalendar();
    }
}
