let idx = 0;
const answers = new Array(questions.length).fill(null);

// ELEMENT
const qNumber = document.getElementById("q-number");
const qText = document.getElementById("q-text");
const optionsWrap = document.getElementById("options");
const prevBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");
const resultWrap = document.getElementById("result");

// HEADER
const progressText = document.getElementById("progress-text");
const progressPill = document.getElementById("progress-pill");

// FINISH
const finishScreen = document.getElementById("finish-screen");
const finalScore = document.getElementById("final-score");

// 🔴 JIKA DB KOSONG
if (!questions || questions.length === 0) {
    qText.innerHTML = "❌ Soal belum tersedia.";
    prevBtn.style.display = "none";
    nextBtn.style.display = "none";
    throw new Error("No questions found");
}

function render() {
    const q = questions[idx];

    // Nomor & soal
    qNumber.textContent = `Soal ${idx + 1}`;
    qText.textContent = q.question;

    // Progress
    const progress = `${idx + 1}/${questions.length} Soal`;
    if (progressText) progressText.textContent = progress;
    if (progressPill) progressPill.textContent = progress;

    // Options
    optionsWrap.innerHTML = "";

    const opts = [
        { letter: "A", text: q.option_a },
        { letter: "B", text: q.option_b },
        { letter: "C", text: q.option_c }
    ];

    opts.forEach(opt => {
        const label = document.createElement("label");
        label.setAttribute("data-letter", opt.letter);

        label.innerHTML = `
            <input type="radio" name="answer" value="${opt.letter}">
            <span>${opt.letter}) ${opt.text}</span>
        `;

        // restore jawaban
        if (answers[idx] === opt.letter) {
            label.classList.add("selected");
            label.querySelector("input").checked = true;
        }

        label.onclick = () => {
            answers[idx] = opt.letter;

            document
                .querySelectorAll("#options label")
                .forEach(l => l.classList.remove("selected"));

            label.classList.add("selected");
            nextBtn.disabled = false;
        };

        optionsWrap.appendChild(label);
    });

    // Tombol
    prevBtn.disabled = idx === 0;
    nextBtn.disabled = answers[idx] === null;

    // Ubah Lanjut → Selesai di soal terakhir
    if (idx === questions.length - 1) {
        nextBtn.textContent = "Selesai";
    } else {
        nextBtn.textContent = "Lanjut";
    }
}

// PREV
prevBtn.onclick = () => {
    if (idx > 0) {
        idx--;
        render();
    }
};

// NEXT / SUBMIT
nextBtn.onclick = () => {
    if (answers[idx] === null) return;

    // 🔴 JIKA SOAL TERAKHIR → FINISH
    if (idx === questions.length - 1) {
        finishQuiz();
        return;
    }

    idx++;
    render();
};

function finishQuiz() {
    let score = 0;

    questions.forEach((q, i) => {
        if (answers[i] === q.correct) score++;
    });

    // sembunyikan quiz
    document.querySelector(".container").style.display = "none";

    // tampilkan finish
    finalScore.innerHTML = `
        Nilai kamu: <strong>${score} / ${questions.length}</strong>
    `;
    finishScreen.style.display = "block";
}

// INIT
render();
