<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/viewProjectRequests/index.css">
<main>
    <div class="row">
        <div class="col-xs-12 center-content">
            <h1 id="h1-c">View Sent Requests</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table table="1" class="table table-hover" id="table-c">
                <thead>
                <tr>
                    <th>To</th>
                    <th>Outline Name</th>
                    <th>Your Project</th>
                    <th>Date Created</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($this->sentRequests as $sr):?>

                    <tr>
                        <td><?=$sr->getOutline()->getTeacher()->getFirstName() . " " . $sr->getOutline()->getTeacher()->getLastName();?></td>
                        <td><?=$sr->getOutline()->getName();?></td>
                        <td><?=$sr->getName();?></td>
                        <td><?=$sr->getDateCreated();?></td>
                        <td><?=$sr->getStatus();?></td>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</main>

