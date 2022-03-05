<?php
$v->layout("theme");

use Source\Models\Provider;
use CoffeeCode\Paginator\Paginator;

$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);
$providers = new Provider();
$paginator = new Paginator("http://localhost/new-pretium/app/fornecedores?page=");
$paginator->pager($providers->find()->count(), 10, $page);
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Fornecedores</h1>
</div>
<div class="row">
    <div class="table-responsive">
        <table id="tableProviders" class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Razão Social</th>
                <th scope="col">CNPJ</th>
                <th scope="col">Endereço</th>
                <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $providersTable = $providers->find()->limit($paginator->offset())->offset($paginator->limit())->fetch(true);
            if ($providersTable) {
                $count = 0;
                foreach ($providersTable as $provider) {
                    $count++;
                    echo "<tr>";
                    echo "<th scope='row'>" . ($paginator->offset() + $count) . "</th>";
                    echo "<td>$provider->social_reason</td>";
                    echo "<td>" . mask('cnpj', $provider->cnpj) . "</td>";
                    echo "<td>$provider->address</td>";
                    echo "<td>$provider->email</td>";
                    echo "<td>" . mask('telephone', $provider->phonenumber) . "</td>";
                    echo "<td><a class='btn btn-sm btn-info text-white'>Ver produtos</a></td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between">
        <?= "<p>Página {$paginator->page()} de {$paginator->pages()}</p>"; ?>
        <?= $paginator->render("paginator"); ?>
    </div>
</div>
<?php $v->start('style'); ?>
<link rel="stylesheet" href="<?= asset("css/datatables.min.css"); ?>">
<?php $v->stop(); ?>

<?php $v->start('script'); ?>
<script src="<?= asset("js/jquery-3.6.0.min.js"); ?>"></script>
<script src="<?= asset("js/datatables.min.js"); ?>"></script>
<script>
    /*$(document).ready(function () {
        $('#table-fornecedores').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "../source/DataTables/fornecedores.php",
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json"
            },
        });
        $('#table-produtos-fornecedores').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "../source/DataTables/produtos_fornecedores.php",
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json"
            },
        });
    });*/
</script>
<?php $v->stop(); ?>

