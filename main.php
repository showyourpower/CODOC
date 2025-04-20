<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Codog prototype main</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/moonspam/NanumSquare@2.0/nanumsquare.css" />

</head>
<style>
  a {
    text-decoration-line: none;
    color: #000;
    font-weight: 600;
    cursor: pointer;
  }

  li {
    transition: all 300ms;
    font-size: 0.9rem;
    list-style-type: none;
    width: 83px;
    height: 25px;
    background: #dddddd;
    text-align: center;
    border-radius: 6px;
    padding: 6px 11px;
    line-height: 27px;
    margin-right: 17px;
    margin-left: -9px;
  }

  li:hover {
    background: #041b4d;
    color: #041b4d;
  }

  li:hover a {
    background: #041b4d;
    color: #fff;
  }

  a:hover {
    color: #fff;
  }

  .container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100vh;

    animation: animation .25s forwards;
  }

  ul {
    display: flex;
    padding: 2px;
    margin-left: 17px;
  }

  h2 {
    text-align: center;
    font-weight: 900;
    font-size: 2.3rem;
    margin-left: -9px;
    letter-spacing: 11px;
    margin-top: 1px;
  }

  body {
    font-family: "NanumSquare", sans-serif;
    text-align: center;
    margin: 0;
    background-color: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .section {
    text-align: center;
    position: relative;
  }

  #logoutButton {
    display: block;
    font-size: 0.8rem;
    list-style-type: none;
    width: 88px;
    height: 26px;
    color: #000;
    background: #dddddd;
    text-align: center;
    border-radius: 6px;
    border: none;
    padding: 6px 11px;
    line-height: 20px;
    margin-right: 22px;
    margin-left: 1px;
  }

  #logoutButton:hover {
    background: #041b4d;
    color: #fff;
  }

  #welcomeMessage {
    font-weight: bold;
    /* 글꼴을 굵게 설정 */
  }

  #userStatus {
    animation: animation2 0.25s forwards;
  }

  @keyframes animation {
    0% {
      transform: translateY(-20px);
      opacity: 0;
    }

    100% {
      transform: translateY(0px);
      opacity: 1;
    }
  }

  @keyframes animation2 {
    0% {
      transform: translateX(20px);
      opacity: 0;
    }

    100% {
      transform: translateX(0px);
      opacity: 1;
    }
  }
</style>

<body>
  <div class="container">
    <div class="section">
      <img src="dog.png" />
      <h2>CODOG</h2>
      <div style="display: flex; flex-direction: column; align-items: center">
        <ul>
          <li id="login"><a href="login.php">로그인</a></li>
          <li id="joinin"><a href="warning.php">회원 가입</a></li>
          <li id="match"><a>매칭 시작</a></li>
        </ul>
      </div>
      <!-- 매칭 활성화 OR 비활성화 버튼 만들고 위의 것을 둘 다 해야 활성화 가능하게 설정 -->
    </div>
  </div>

  <div id="userStatus" style="position: absolute; top: 10px; right: 30px">
    <p id="welcomeMessage"></p>
    <button id="logoutButton" style="display: none">로그아웃</button>
  </div>

  <script>
    window.onload = function () {
      var loggedInUser = sessionStorage.getItem("loggedInUser");
      if (loggedInUser) {
        var user = JSON.parse(loggedInUser);
        document.getElementById("welcomeMessage").innerText =
          "안녕하세요, " + user.name + "님!";
        document.getElementById("logoutButton").style.display = "block";
        document.getElementById("login").style.display = "none"; // 로그인 버튼 감추기
        document.getElementById("joinin").style.display = "none"; // 회원 가입 버튼 감추기

        // 매칭 시작 버튼 클릭 이벤트 처리
        document
          .getElementById("match")
          .addEventListener("click", function () {
            // 이미 로그인 상태이므로 매칭 페이지로 이동
            window.location.href = "find.php";
          });
      } else {
        document.getElementById("welcomeMessage").innerText =
          "로그인이 필요합니다.";
        document.getElementById("logoutButton").style.display = "none";
        document.getElementById("login").style.display = "block"; // 로그인 버튼 보이기
        document.getElementById("joinin").style.display = "block"; // 회원 가입 버튼 보이기

        // 매칭 시작 버튼 클릭 이벤트 처리
        document
          .getElementById("match")
          .addEventListener("click", function () {
            // 로그인되지 않았으므로 알림창 표시
            alert("로그인이 필요합니다.");
          });
      }
    };

    function logout() {
      // 로그아웃 시 세션에서 사용자 정보를 제거하고 초기 메인 페이지 상태로 돌아갑니다
      sessionStorage.removeItem("loggedInUser");
      window.location.href = "main.php";
    }

    document.getElementById("logoutButton").addEventListener("click", logout);
  </script>
</body>

</html>