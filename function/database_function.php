<?php
    function getCategoryName($conn, $category_id){
        $query = "SELECT category_name FROM Category WHERE category_id = '$category_id'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "KHÔNG KẾT NỐI ĐƯỢC DATABASE !!!" . mysqli_errno($conn);
            exit;
        }

        if ($result->num_rows == 0) {
            echo "DANH MỤC SẢN PHẨM TRỐNG";
			exit;
        }

        $row = mysqli_fetch_assoc($result);
        return $row['category_name'];
    }

    function getChildCategories($conn, $parent_id){
        $child_categories = array();
        $query = "SELECT * FROM Category WHERE category_parent_id = $parent_id";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $child_categories[] = $row['category_id'];
            //Gọi đệ quy để lấy các category con của category hiện tại
            $child_categories = array_merge($child_categories, getChildCategories($conn, $row['category_id']));
        }
        
        return $child_categories;
    }

    function getBill($conn, $user_id) {
        $query = "SELECT * FROM Bill WHERE id_user = '$user_id'";
        $result = mysqli_query($conn, $query);
        return $result;
    }

?>