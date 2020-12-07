$(document).ready(function() {
    $('.adminLogin').click(function() {
        $("#loginForm").attr("action", "loginUser");
        $("#flag").val(1);
        $("#jobSeekerUserName").val("");
        $("#jobSeekerPassword").val("");
        $("#companyUserName").val("");
        $("#companyPassword").val("");
        $('#loginForm').submit();
    });
    $('.companyLogin').click(function() {
        $("#loginForm").attr("action", "loginUser");
        $("#flag").val(2);
        $("#jobSeekerUserName").val("");
        $("#jobSeekerPassword").val("");
        $("#adminUserName").val("");
        $("#adminPassword").val("");
        $('#loginForm').submit();
    });
    $('.jobSeekerLogin').click(function() {
        $("#loginForm").attr("action", "loginUser");
        $("#flag").val(3);
        $("#companyUserName").val("");
        $("#companyPassword").val("");
        $("#adminUserName").val("");
        $("#adminPassword").val("");
        $('#loginForm').submit();
    });
});