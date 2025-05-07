<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pesan Mahasiswa</title>
 <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;

  }
  
  body {
    background-color: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  
  .container {
    width: 100%;
    /* width: 350px; */
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    height: 100vh;
    margin: auto;
    padding: 20px;
    
    
  }
  
  .header {
    
    background-color: #41bfb3;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 10px;
  }
  
  .profile {
    display: flex;
    align-items: center;
    gap: 8px;
    color: white;
    font-weight: bold;
  }
  
  .profile img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
  }
  
  .notif {
    position: relative;
  }
  
  .notif img {
    width: 30px;
  }
  
  .dot {
    position: absolute;
    top: 0;
    right: 0;
    width: 10px;
    height: 10px;
    background: red;
    border-radius: 50%;
    border: 2px solid white;
  }
  
  .menu {
    
    border: 2px solid #41bfb3;
    border-radius: 20px;
    padding: 5px;
    display: flex;
    justify-content: space-around;
    margin-bottom: 30px;
  }
  
  .menu button {
    padding: 6px 25px;
    border: 2px solid #41bfb3;
    background: white;
    border-radius: 20px;
    cursor: pointer;
    font-weight: bold;
  }
  
  .menu .active {
    background: #41bfb3;
    color: white;
  }
  
  .form-section {
    padding: 10px;
  }
  
  .form-section h3 {
    margin-bottom: 10px;
  }
  
  form {
    
    border: 2px solid #41bfb3;
    border-radius: 10px;
    padding: 10px;
    display: flex;
    flex-direction: column;
    margin-bottom: 50px;
   
    
  }
  
  form label {
    font-size: 0.9em;
    margin: 5px 0 3px;
  }
  
  form select,
  form textarea {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 10px;
    resize: none;
  }
  
  form textarea {
    height: 80px;
  }
  
  .submit-btn {
    background-color: #41bfb3;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
    width: 35%;
  }
  
  .submit-btn:hover {
    background-color: #369e91;
  }
  
  .button-container{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    

  }
 </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="profile">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User" />
        <span>Hi, Ahmad !!</span>
      </div>
      <div class="notif">
        <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Mail" />
        <div class="dot"></div>
      </div>
    </div>

    <div class="menu">
      <button>Beranda</button>
      <button class="active">Pesan</button>
      <button>Riwayat</button>
    </div>

    <div class="form-section">
      <h3>Masukan Kritik Dan Saran</h3>
      <form>
        <label for="from">From :</label>
        <select id="from">
          <option>Ahmad</option>
        </select>

        <label for="to">To :</label>
        <select id="to">
          <option>Fakultas MIPA</option>
        </select>

        <label for="pesan">Pesan :</label>
        <textarea id="pesan" placeholder="Masukkan Pesan"></textarea>

        
      </form>
      <div class="button-container">
        <button type="submit" class="submit-btn">KIRIM</button>

      </div>
    </div>
  </div>
</body>
</html>
