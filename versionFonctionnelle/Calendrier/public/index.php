<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/calendar.css">
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-3">
    <a href="../../../index.php" class="navbar-brand">Retour à l'accueil</a>
</nav>

<?php
require '../src/Calendar/Month.php';
try {
 $month = new Calendar\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
} catch (\Exception $e){
    $month = new Calendar\Month();
}
$start = $month->getStartingDay();
$start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
$weeks = $month->getWeeks();
?>

<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
    <h1><?= $month->toString(); ?></h1>
    <div>
        <a href="./index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt;</a>
        <a href="./index.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt;</a>
    </div>
</div>


<table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
    <?php for ($i = 0; $i < $weeks; $i++): ?>
    <tr>
        <?php 
        foreach($month->days as $k => $day): 
            $date = (clone $start)->modify("+" .($k + $i * 7). "days")
            ?>
        <td class ="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?> ">
            <?php if ($i === 0): ?>
                <div class="calendar__weekday"><?= $day; ?></div>
            <?php endif; ?>
            <div class="calendar__day"><?= (clone $start)->modify("+" .($k + $i * 7). "days")->format('d'); ?></div>
        </td>
    <?php endforeach; ?>
    </tr>
    <?php endfor; ?>
</table>

</body>
</html>