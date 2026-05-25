<h1><?= $clinic ?></h1>
<p>Welcome to Mini Clinic App</p>

<h2>Appointment List</h2>

<?php foreach ($appointments as $a): ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <h3>Doctor: <?= $a['doctor'] ?></h3>
        <p>Date: <?= $a['date'] ?></p>
        <p>Seats: <?= $a['available'] ?>/<?= $a['total'] ?></p>
        <p>Status: 
            <strong style="color: <?= $a['status'] === 'Open' ? 'green' : 'red' ?>">
                <?= $a['status'] ?>
            </strong>
        </p>
    </div>
<?php endforeach; ?>