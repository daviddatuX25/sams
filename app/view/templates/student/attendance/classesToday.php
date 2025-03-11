<!-- CSS -->
<style>
        body { font-family: Arial, sans-serif; }
        .timeline-container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .timeline {
            position: relative;
            padding-left: 40px;
            margin-left: 20px;
            border-left: 2px solid black;
        }
        .event {
            margin: 10px 0;
            padding: 10px;
            background: #f4f4f4;
            border-radius: 5px;
            position: relative;
        }
        .event:before {
            content: "";
            width: 12px;
            height: 12px;
            background: black;
            border-radius: 50%;
            position: absolute;
            left: -28px;
            top: 10px;
        }
        .time {
            font-weight: bold;
        }
        .details {
            margin-left: 10px;
        }
    </style>


<!-- HTML with DATA -->
<div class="timeline-container">
    <h2>Schedule Timeline</h2>
    <div class="timeline">
        <?php foreach ($todayClassesData as $classSession): ?>
            <div class="event">
                <div class="time"><?= $classSession['time_start'] ?> - <?= $classSession['time_end'] ?></div>
                <div class="details">
                    <strong><?= $classSession['subject'] ?></strong><br>
                    <?php if (isset($classSession['instructor'])): ?>
                        <small>Instructor: <?= $classSession['instructor'] ?></small>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>