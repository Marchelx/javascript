<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Soal JavaScript</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #f7fafc, #edf2f7); /* Soft gradient background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #4a5568; /* Darker text for better readability */
        }
        .container {
            width: 100%;
            max-width: 900px;
            background-color: #ffffff; /* White background for the quiz */
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            font-size: 36px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 40px;
            letter-spacing: 1px;
        }
        .progress-bar {
            width: 100%;
            height: 8px;
            background-color: #e2e8f0;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .progress {
            width: 0%;
            height: 100%;
            background-color: #5a67d8;
            border-radius: 4px;
        }
        .question {
            background-color: #f9fafb;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .question:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        textarea {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin-top: 12px;
            border: 2px solid #cbd5e0;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s ease-in-out;
        }
        textarea:focus {
            border-color: #5a67d8;
            box-shadow: 0 0 5px rgba(90, 103, 216, 0.5);
        }
        button {
            background-color: #5a67d8;
            color: white;
            font-size: 18px;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s ease;
        }
        button:hover {
            background-color: #434190;
            transform: translateY(-2px);
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #718096;
        }
        .footer span {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Latihan Soal - Dasar-Dasar JavaScript</h2>
        
        <div class="progress-bar">
            <div class="progress"></div>
        </div>

        <div id="quiz"></div>

        <button onclick="checkAnswers()">Cek Jawaban</button>

        <div class="footer">
            <p>*Jawaban Anda akan dibandingkan dengan jawaban yang benar setelah menekan tombol "Cek Jawaban".</p>
            <p><span>*Silakan masukkan jawaban Anda di atas.</span></p>
        </div>

        <p id="result"></p>
    </div>

    <script>
        const questions = [
            { q: "Apa perbedaan utama antara var, let, dan const dalam JavaScript?", a: "var dapat dideklarasikan ulang dan memiliki scope function, let memiliki scope block, const bersifat tetap dan tidak dapat diubah.", explanation: "var dapat dideklarasikan ulang di dalam scope yang sama, sedangkan let dan const tidak. let memiliki scope block, sedangkan var memiliki scope function." },
            { q: "Apa output dari kode berikut?\nvar x = 10; let y = 5; const z = 20; x = 15; y = 10; z = 25; console.log(x, y, z);", a: "Error karena z tidak dapat diubah.", explanation: "z dideklarasikan dengan const, sehingga tidak bisa diubah setelah dideklarasikan." },
            { q: "Perbaiki kode di atas agar tidak terjadi error!", a: "var x = 10; let y = 5; const z = 20; x = 15; y = 10; console.log(x, y, z);", explanation: "Hapus atau ubah z agar tidak diubah setelah dideklarikan." },
            { q: "Tentukan tipe data dari masing-masing variabel berikut: let a = 'Hello'; let b = 42; let c = true; let d = [1, 2, 3]; let e = { name: 'Alice', age: 25 };", a: "String, Number, Boolean, Array, Object", explanation: "Tipe data di JavaScript termasuk String, Number, Boolean, Array, dan Object." },
            { q: "Buatlah sebuah array yang berisi 5 nama buah dan tampilkan elemen ketiga!", a: "let buah = ['Apel', 'Jeruk', 'Mangga', 'Pisang', 'Durian']; console.log(buah[2]);", explanation: "Indeks array dimulai dari 0, sehingga elemen ketiga adalah 'Mangga'." },
            { q: "Buatlah sebuah object yang berisi informasi nama, umur, dan pekerjaan seseorang, lalu tampilkan nilai dari properti nama.", a: "let orang = {nama: 'Budi', umur: 25, pekerjaan: 'Programmer'}; console.log(orang.nama);", explanation: "Properti dapat diakses menggunakan notasi titik." },
            { q: "Apa hasil dari operasi berikut? console.log(10 + '5'); console.log(10 - '5'); console.log(10 === '10'); console.log(10 == '10'); console.log(true && false); console.log(true || false); console.log(!true);", a: "105, 5, false, true, false, true, false", explanation: "Operasi penjumlahan dengan string mengkonversi angka menjadi string, sedangkan pengurangan mengkonversi string menjadi angka." },
            { q: "Buat kode yang menggunakan operator perbandingan untuk mengecek apakah sebuah angka lebih besar dari 100 dan lebih kecil dari 500!", a: "let num = 200; console.log(num > 100 && num < 500);", explanation: "Operator && digunakan untuk mengecek dua kondisi." },
            { q: "Buat program if-else untuk menentukan apakah sebuah angka ganjil atau genap.", a: "let num = 10; if (num % 2 === 0) { console.log('Genap'); } else { console.log('Ganjil'); }", explanation: "Modulus (%) digunakan untuk menentukan sisa bagi." },
            { q: "Gunakan switch-case untuk mencetak nama hari berdasarkan nomor (1 = Senin, 2 = Selasa, ... 7 = Minggu).", a: "let hari = 3; switch(hari) { case 1: console.log('Senin'); break; case 2: console.log('Selasa'); break; case 3: console.log('Rabu'); break; case 4: console.log('Kamis'); break; case 5: console.log('Jumat'); break; case 6: console.log('Sabtu'); break; case 7: console.log('Minggu'); break; default: console.log('Hari tidak valid'); }", explanation: "Switch-case digunakan untuk memilih antara beberapa opsi." },
            { q: "Gunakan for loop untuk mencetak angka dari 1 hingga 10.", a: "for(let i = 1; i <= 10; i++) { console.log(i); }", explanation: "For loop digunakan untuk iterasi dengan kontrol variabel." },
            { q: "Gunakan while loop untuk mencetak angka dari 10 hingga 1.", a: "let i = 10; while(i >= 1) { console.log(i); i--; }", explanation: "While loop akan terus berjalan selama kondisi benar." },
            { q: "Gunakan do-while loop untuk mencetak angka dari 1 hingga 5.", a: "let i = 1; do { console.log(i); i++; } while(i <= 5);", explanation: "Do-while loop akan menjalankan blok kode setidaknya sekali." }
        ];

        function loadQuiz() {
            const quizDiv = document.getElementById("quiz");
            questions.forEach((item, index) => {
                quizDiv.innerHTML += `
                    <div class='question'>
                        <p class='text-xl font-semibold mb-2'>${index + 1}. ${item.q}</p>
                        <textarea id='ans${index}' rows="4" placeholder="Masukkan jawaban Anda...">${item.a}</textarea>

                        <p id='ans${index}Correct' class='hidden text-green-600 mt-2 font-semibold'>Jawaban Benar: ${item.a}</p>
                        <p class='text-sm text-gray-600 mt-1'>Penjelasan: ${item.explanation}</p>
                    </div>
                `;
            });
        }

        function checkAnswers() {
            questions.forEach((_, index) => {
                document.getElementById(`ans${index}Correct`).classList.remove("hidden");
            });
        }

        loadQuiz();
    </script>
</body>
</html>
