<?php $v->layout("theme"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cotações recebidas</h1>
</div>
<div class="row">
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Status</th>
                <th scope="col">ID da Cotação</th>
                <th scope="col">Remetente</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $count = 0;
            if ($quotes):
                foreach ($quotes as $quote):
                    $count++;
                    ?>
                    <tr>
                        <th scope="row"><?= $count; ?></th>
                        <td class="fw-bold <?= ($quote->status()->name == 'Nova Solicitação' ? 'text-warning' : ''); ?>"><?= $quote->status()->name; ?></td>
                        <td><?= $quote->id; ?></td>
                        <td><?= $quote->user()->username . ' (<strong>' . $quote->provider()->social_reason . '</strong>)'; ?></td>
                        <td><a class="btn btn-info btn-sm view" data-id="<?= $quote->id; ?>"><i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php endforeach;
            endif; ?>
            </tbody>
        </table>
    </div>
</div>
