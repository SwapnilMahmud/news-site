<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <?php
             include"config.php";
             $post_id=$_GET['id'];
             $sqle="SELECT post.post_id, post.title, post.description, post.post_img,post.category,category.category_name FROM post LEFT JOIN category ON post.category=category.category_id LEFT JOIN user ON post.author=user.user_id WHERE post.post_id = {$post_id}";
             $resulte=mysqli_query($conn,$sqle) or die("query fssssiled.....");
             if(mysqli_num_rows($resulte)>0){
             while($row=mysqli_fetch_assoc($resulte)){
         ?>
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                 <?php echo $row['description']; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                  <option  disabled> Select Category</option>
                  <?php
                     include"config.php";
                     $sql1="SELECT * FROM category";
                     $result1=mysqli_query($conn,$sql1) or die("Query faield");
                     if(mysqli_num_rows($result1)>0){
                       while($rows=mysqli_fetch_assoc($result1)){
                         if($row['category'] == $rows['category_id']){
                           $selected="selected";
                         }
                         else{
                           $selected="";
                         }
                         echo "<option {$selected} value='{$rows['category_id']}'> {$rows['category_name']}</option>";
                       }

                     }
                  ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']; ?>" height="150px">
              <input type="hidden" name="old_image" value="<?php echo $row['post_img']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
      <?php
    }
  }else{
    echo "Result not found!";
  }

      ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
