<?php
    include_once("templates/header.php");
    if(isset($_GET['id'])){
        $postId = $_GET['id'];
        $currentPost;

        foreach($posts as $post){
            if($post['id']==$postId){
                $currentPost = $post;
            }
        }
    }
?>
<main id="post-container">
    <div class="content-container">
        <h1><?= $currentPost['title']?></h1>
        <p id="post-description"><?= $currentPost['description']?></p>
        <div class="img-container">
            <img src="<?= $BASE_URL ?>/img/<?= $currentPost['img']?>" alt="<?= $currentPost['title']?>">
        </div>
    <p class="post-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni modi quasi provident optio voluptatem, fuga in voluptas quidem quas exercitationem veritatis temporibus, ea totam. Architecto nihil dicta illo officia mollitia?
    Suscipit optio eveniet facilis vel ipsum minima blanditiis architecto alias! Maxime, quia excepturi magnam odio quae aut adipisci culpa quam autem qui veritatis in sint. Iste nisi optio numquam. Maiores!
    Odit, harum animi dignissimos tempore sequi magnam voluptate distinctio adipisci similique mollitia, praesentium expedita eius deleniti velit molestiae amet aperiam eveniet tenetur perspiciatis, ipsum delectus odio! Dolore nihil facilis numquam!
    Tempora eum omnis quo quod, cupiditate sequi odit illo quas porro ratione velit aliquid possimus provident eius! Delectus, molestias quisquam exercitationem fugiat ipsa esse animi sapiente rerum numquam. Vitae, sed.
    Modi velit nam ipsam doloribus laudantium ratione quibusdam incidunt accusantium dignissimos error, natus suscipit fugiat eaque aliquam perferendis voluptas consequuntur totam molestiae illum asperiores unde facere? In amet veniam eligendi.</lorem></p>

    <p class="post-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni modi quasi provident optio voluptatem, fuga in voluptas quidem quas exercitationem veritatis temporibus, ea totam. Architecto nihil dicta illo officia mollitia?
    Suscipit optio eveniet facilis vel ipsum minima blanditiis architecto alias! Maxime, quia excepturi magnam odio quae aut adipisci culpa quam autem qui veritatis in sint. Iste nisi optio numquam. Maiores!
    Odit, harum animi dignissimos tempore sequi magnam voluptate distinctio adipisci similique mollitia, praesentium expedita eius deleniti velit molestiae amet aperiam eveniet tenetur perspiciatis, ipsum delectus odio! Dolore nihil facilis numquam!
    Tempora eum omnis quo quod, cupiditate sequi odit illo quas porro ratione velit aliquid possimus provident eius! Delectus, molestias quisquam exercitationem fugiat ipsa esse animi sapiente rerum numquam. Vitae, sed.
    Modi velit nam ipsam doloribus laudantium ratione quibusdam incidunt accusantium dignissimos error, natus suscipit fugiat eaque aliquam perferendis voluptas consequuntur totam molestiae illum asperiores unde facere? In amet veniam eligendi.</lorem></p>
    </div>
    
    <aside id="nav-container">
    <h3 id="tags-title">Tags</h3>
    <ul id="tag-list">
        <?php foreach($currentPost['tags'] as $tag): ?>
            <li><a href="#"><?= $tag ?></a></li>
        <?php endforeach; ?>

        </ul>
        <h3 id="categories-title">Categorias</h3>
        <ul id="categories-list">
            <?php foreach($categories as $category): ?>
                <li><a href="#"><?= $category ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>
</main>



<?php
    include_once('templates/footer.php');
?>