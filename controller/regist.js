function validateRegist() {

  const nama = document.getElementById('nama').value;

  const alamat = document.getElementById('alamat').value;

  const gender = document.getElementById('gender').value;

  const username = document.getElementById('username').value;

  const password = document.getElementById('password').value;

  let errorMessage = '';

  if (!nama) {

    errorMessage += 'Nama harus diisi.\n';

  }

  if (!alamat) {

    errorMessage += 'Alamat harus diisi.\n';

  }

  if (!gender) {

    errorMessage += 'Gender harus diisi.\n';

  }

  if (!username) {

    errorMessage += 'Username/Email harus diisi.\n';

  }

  if (!password) {

    errorMessage += 'Password harus diisi.\n';

  }

  if (errorMessage) {

    alert(errorMessage);

    return false;

  } else {

    event.preventDefault();
    alert('Registrasi Berhasil , Silahkan Login ');
    window.location.href = 'login.html';
  }

}