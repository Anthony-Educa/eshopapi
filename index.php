<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EshopApi</title>
    </head>
    <body>
        <table border="1" width:"80%" align="center">
        <?php
        include_once 'bootstrap.inc.php';
        $produit = new Produit();
        $produits = Produit::fetchAll();
        var_dump($produits);
        foreach ($produits as $unProduit): 
            ?>
               <tr>
                <td>
                    <?php echo $unProduit -> getIdProduit(); ?>
                </td>
                <td>
                    <?php echo $unProduit -> getLibelle(); ?>
                </td>
                <td>
                    <?php echo $unProduit -> getDescription(); ?>
                </td>
                <td>
                    <?php echo $unProduit -> getPrix(); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>