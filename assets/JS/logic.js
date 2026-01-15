let idx = 0;
const answers = new Array(questions.length).fill(null);

const qNumber = document.getElementById("q-number");
const qText = document.getElementById("q-text");
const optionsWrap = document.getElementById("options");
const progressPill = document.getElementById("progress-pill");
const prevBtn = document.getElementById("prev-btn");
const nextBtn = document.getElementById("next-btn");
const submitBtn = document.getElementById("submit-btn");
const resultWrap = document.getElementById("result-wrap");

function render() {
    const curr = questions[idx];

    qNumber.textContent = `Soal ${idx + 1}`;
    qText.textContent = curr.question;
    progressPill.textContent = `${idx + 1}/${questions.length} Soal`;

    optionsWrap.innerHTML = "";

    ["A","B","C"].forEach(opt => {
        const wrapper = document.createElement("label");
        wrapper.className = "option";
        wrapper.innerHTML = `
            <input type="radio" name="choice" value="${opt}">
            <div>${opt}. ${curr["option_" + opt.toLowerCase()]}</div>
        `;

        const input = wrapper.querySelector("input");
        if (answers[idx] === opt) input.checked = true;

        input.addEventListener("change", () => {
            answers[idx] = opt;
            nextBtn.disabled = false;
        });

        optionsWrap.appendChild(wrapper);
    });

    prevBtn.disabled = idx === 0;

    if (idx === questions.length - 1) {
        nextBtn.style.display = "none";
        submitBtn.style.display = "inline-block";
    } else {
        nextBtn.style.display = "inline-block";
        submitBtn.style.display = "none";
    }

    nextBtn.disabled = answers[idx] === null;
}

prevBtn.onclick = () => {
    if (idx > 0) idx--;
    render();
};

nextBtn.onclick = () => {
    if (answers[idx] === null) {
        alert("Pilih jawaban dulu ya");
        return;
    }
    idx++;
    render();
};

submitBtn.onclick = () => {
    fetch("submit_quiz.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({
            answers: answers,
            questions: questions,
            categoryId: categoryId
        })
    })
    .then(res => res.json())
    .then(data => {
        resultWrap.innerHTML = `
            <div class="result">
                <strong>Hasil: ${data.score} / ${questions.length}</strong>
            </div>
        `;
    });
};

render();
