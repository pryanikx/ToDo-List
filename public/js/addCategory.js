document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("addCategoryBtn").addEventListener("click", function() {
        var container = document.getElementById("newCategoryContainer");
        container.style.display = "block";
        document.getElementById("newCategoryInput").focus();
    });
});