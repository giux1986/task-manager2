<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class Task extends Component
{
    public $name;
    public $description;
    public $start_date;
    public $end_date;
    public $duration;

    public $frequency_options = [
        'daily' => 'Every day',
        'weekly' => 'Every week',
        'biweekly' => 'Every other week',
        'monthly' => 'Every month',
        'yearly' => 'Every year',
    ];
    public $weekdays_options = [
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday',
    ];

    public $selected_frequency;
    public $selected_weekdays = [];
    public $selected_monthday;
    public $selected_month;

    public function createTask()
    {
        $start_date = new \DateTime($this->start_date);
        $end_date = new \DateTime($this->end_date);

        if ($this->selected_frequency === 'daily') {
            $interval = new \DateInterval('P1D');
            $period = new \DatePeriod($start_date, $interval, $end_date);

            foreach ($period as $date) {
                Task::create([
                    'name' => $this->name,
                    'description' => $this->description,
                    'start_date' => $date->format('Y-m-d H:i:s'),
                    'end_date' => $date->add(new \DateInterval('PT'.$this->duration.'M'))->format('Y-m-d H:i:s'),
                    'frequency' => $this->selected_frequency,
                    'duration' => $this->duration,
                ]);
            }
        }

        if ($this->selected_frequency === 'weekly') {
            $interval = new \DateInterval('P1W');
            $period = new \DatePeriod($start_date, $interval, $end_date);

            foreach ($period as $date) {
                if (in_array(strtolower($date->format('l')), $this->selected_weekdays)) {
                    Task::create([
                        'name' => $this->name,
                        'description' => $this->description,
                        'start_date' => $date->format('Y-m-d H:i:s'),
                        'end_date' => $date->add(new \DateInterval('PT'.$this->duration.'M'))->format('Y-m-d H:i:s'),
                        'frequency' => $this->selected_frequency,
                        'duration' => $this->duration,
                    ]);
                }
            }
        }

        if ($this->selected_frequency === 'biweekly') {
            $interval = new \DateInterval('P2W');
            $period = new \DatePeriod($start_date, $interval, $end_date);

            foreach ($period as $date) {
                if (in_array(strtolower($date->format('l')), $this->selected_weekdays)) {
                    Task::create([
                        'name' => $this->name,
                        'description' => $this->description,
                        'start_date' => $date->format('Y-m-d H:i:s'),
                        'end_date' => $date->add(new \DateInterval('PT'.$this->duration.'M'))->format('Y-m-d H:i:s'),
                        'frequency' => $this->selected_frequency,
                        'duration' =>                    $this->duration,
                ]);
            }
        }
    }

    if ($this->selected_frequency === 'monthly') {
        $interval = new \DateInterval('P1M');
        $period = new \DatePeriod($start_date, $interval, $end_date);

        foreach ($period as $date) {
            if ($date->format('j') == $this->selected_monthday) {
                Task::create([
                    'name' => $this->name,
                    'description' => $this->description,
                    'start_date' => $date->format('Y-m-d H:i:s'),
                    'end_date' => $date->add(new \DateInterval('PT'.$this->duration.'M'))->format('Y-m-d H:i:s'),
                    'frequency' => $this->selected_frequency,
                    'duration' => $this->duration,
                ]);
            }
        }
    }

    if ($this->selected_frequency === 'yearly') {
        $interval = new \DateInterval('P1Y');
        $period = new \DatePeriod($start_date, $interval, $end_date);

        foreach ($period as $date) {
            if ($date->format('n') == $this->selected_month && $date->format('j') == $this->selected_monthday) {
                Task::create([
                    'name' => $this->name,
                    'description' => $this->description,
                    'start_date' => $date->format('Y-m-d H:i:s'),
                    'end_date' => $date->add(new \DateInterval('PT'.$this->duration.'M'))->format('Y-m-d H:i:s'),
                    'frequency' => $this->selected_frequency,
                    'duration' => $this->duration,
                ]);
            }
        }
    }

    $this->reset();
    $this->emit('taskCreated');
}

public function render()
{
    return view('livewire.task');
}

