<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <style>
      body {
        font-family: "NanumSquare", sans-serif;
        text-align: center;
        background-color: #f5f5f5;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }
      .container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
        padding: 20px;
      }
      h2 {
        margin-bottom: 20px;
      }
      input {
        width: 90%;
        padding: 10px;
        margin: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
      }
      button {
        width: 95%;
        padding: 10px;
        background-color: #0052aa;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
      }
      button:hover {
        background-color: #002b58;
      }
      p#message {
        margin-top: 10px;
        font-size: 16px;
      }
    </style>

    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/gh/moonspam/NanumSquare@2.0/nanumsquare.css"
    />
  </head>
  <body>
    <div class="container">
      <h2>Login</h2>
      <input
        type="text"
        id="username"
        placeholder="강아지 이름"
        onkeypress="handleKeyPress(event)"
      />
      <input
        type="password"
        id="password"
        placeholder="비밀번호"
        onkeypress="handleKeyPress(event)"
      />
      <button id="loginButton">로그인</button>
    </div>

    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script>
      var config = {
        apiKey: "AIzaSyCzxhqJmQKs1BgXd2UMSI5hZL4VXjlcU7Q",
        authDomain: "firm-affinity-384813.firebaseapp.com",
        databaseURL: "https://firm-affinity-384813-default-rtdb.firebaseio.com",
        projectId: "firm-affinity-384813",
        storageBucket: "firm-affinity-384813.appspot.com",
        messagingSenderId: "800396532197",
        appId: "1:800396532197:web:2a92fa1c5bbec23b8db70c",
      };
      // Initialize Firebase
      firebase.initializeApp(config);

      function login() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username === "" || password === "") {
          alert("강아지 이름과 비밀번호를 모두 입력해주세요.");
          return;
        }

        var ref = firebase.database().ref("posts");
        ref.once("value").then(function (snapshot) {
          var posts = snapshot.val();
          var found = false;

          for (var key in posts) {
            var post = posts[key];
            if (post.name === username && post.password === password) {
              found = true;
              sessionStorage.setItem("loggedInUser", JSON.stringify(post));
              window.location.href = "main.php"; // 로그인 성공 시 메인 페이지로 이동
              return;
            }
          }

          if (!found) {
            alert("강아지 이름 혹은 비밀번호가 잘못 되었습니다"); // 로그인 실패 시 알림창 표시
          }
        });
      }

      function handleKeyPress(event) {
        if (event.key === "Enter") {
          login();
        }
      }

      document.getElementById("loginButton").addEventListener("click", login);
    </script>
  </body>
</html>
