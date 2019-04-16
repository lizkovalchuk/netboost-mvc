<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/viewProjectRequests/index.css">
<main>
    <div class="row">
        <div class="col-xs-12 center-content">
            <h1 id="h1-c">View Requests</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table table="1" class="table table-hover" id="table-c">
                <thead>
                <tr>
                    <th>Company</th>
                    <th>Project Name</th>
                    <th>Teacher Outline</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>Project</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($this->requests as $r):?>

                <tr>
                    <td><?=$r->getCompany()->getName();?></td>
                    <td><?=$r->getName();?></td>
                    <td><?=$r->getOutline()->getName();?></td>
                    <td><?=$r->getDateCreated();?></td>
                    <td>
                        <?php if($r->getStatus() == 'Sent') {?>
                            <a class="btn yeg-btn" name="accepted" href="<?= BASE_PATH?>viewProjectRequests/acceptProject/<?=$r->getId()?>">Accept</a>
                            <a class="btn yeg-btn" name="declined" href="<?= BASE_PATH?>viewProjectRequests/declineProject/<?=$r->getId()?>">Decline</a>
                        <?php } else {echo $r->getStatus(); }?>
                    </td>
                    <td>
                        <a class="btn yeg-btn" href="<?= BASE_PATH?>viewProjectRequests/details/<?=$r->getId()?>">View Project</a>
                        <a class="btn yeg-btn" href="<?=BASE_PATH?>messageSystem/newChatKnownRecipient/<?=$r->getCompany()->getId();?>">Message</a>
                    </td>
                </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>
</main>
