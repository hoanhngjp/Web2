document.addEventListener('DOMContentLoaded', function() {
    var menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(function(item) {
        item.addEventListener('click', function(event) {
            var subMenu = item.querySelector('.sub-menu');
            if (subMenu) {
                if (subMenu.classList.contains('active')) {
                    subMenu.classList.remove('active'); // Ẩn sub-menu nếu đã hiển thị
                } else {
                    // Ẩn tất cả các sub-menu khác trước khi hiển thị sub-menu mới
                    document.querySelectorAll('.sub-menu').forEach(function(menu) {
                        menu.classList.remove('active');
                    });
                    subMenu.classList.add('active'); // Hiển thị sub-menu
                }
                event.preventDefault(); // Chỉ chặn hành động mặc định của thẻ a trong menu-item đã nhấp vào
            }
        });
    });
});
