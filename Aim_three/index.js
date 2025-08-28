const gridContainer = document.getElementById('gridContainer');
const gridSize = 20;
for (let i = 0; i < gridSize * gridSize; i++) {
    const square = document.createElement('div');
    square.className = 'grid-square';
    gridContainer.appendChild(square);
}

document.addEventListener('mousemove', (e) => {
    const squares = document.querySelectorAll('.grid-square');
    const mouseX = e.clientX;
    const mouseY = e.clientY;

    squares.forEach((square) => {
        const rect = square.getBoundingClientRect();
        const squareCenterX = rect.left + rect.width / 2;
        const squareCenterY = rect.top + rect.height / 2;
        const distance = Math.sqrt(
            Math.pow(mouseX - squareCenterX, 2) + 
            Math.pow(mouseY - squareCenterY, 2)
        );

        if (distance < 100) {
            square.classList.add('lit');
        } else {
            square.classList.remove('lit');
        }
    });
});

function createParticle() {
    const particle = document.createElement('div');
    particle.className = 'particle';
    particle.style.left = Math.random() * 100 + '%';
    particle.style.width = Math.random() * 4 + 2 + 'px';
    particle.style.height = particle.style.width;
    particle.style.animationDelay = Math.random() * 2 + 's';
    document.getElementById('particles').appendChild(particle);
    setTimeout(() => particle.remove(), 6000);
}

setInterval(createParticle, 300);

// Logo click transition to AI assistant
const mainLogo = document.getElementById('mainLogo');
const logoSection = document.getElementById('logoSection');
const aiContainer = document.getElementById('aiContainer');

let hasClicked = false;

mainLogo.addEventListener('click', () => {
    if (hasClicked) return;
    hasClicked = true;
    
    mainLogo.classList.add('logo-rotating');
    setTimeout(() => {
        logoSection.classList.add('intro-fade-out');
        setTimeout(() => {
            aiContainer.classList.add('active');
            startVoiceAssistant();
        }, 400);
    }, 500);
});

// Hover effects
mainLogo.addEventListener('mouseenter', () => {
    if (!hasClicked) {
        mainLogo.style.transform = 'scale(1.1)';
        mainLogo.style.filter = 'drop-shadow(0 0 30px rgba(255, 255, 255, 0.3))';
    }
});

mainLogo.addEventListener('mouseleave', () => {
    if (!hasClicked) {
        mainLogo.style.transform = 'scale(1)';
        mainLogo.style.filter = 'none';
    }
});

// Voice Assistant Functionality
let recognition;
let isListening = false;
let continuousMode = false;

function startVoiceAssistant() {
    if ("webkitSpeechRecognition" in window || "SpeechRecognition" in window) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = "en-US";

        recognition.onstart = function () {
            isListening = true;
        };

        recognition.onresult = function (event) {
            const userText = event.results[0][0].transcript;
            console.log("Heard:", userText);
            
            processVoiceCommand(userText);
        };

        recognition.onerror = function (event) {
            console.error("Speech recognition error:", event.error);
            setTimeout(() => {
                if (continuousMode) startListening();
            }, 1000);
        };

        recognition.onend = function () {
            isListening = false;
            
            // Restart listening immediately for always-on mode
            setTimeout(() => {
                if (continuousMode) startListening();
            }, 100);
        };

        // Start continuous listening mode
        continuousMode = true;
        startListening();
    } else {
        document.getElementById('responseDisplay').innerHTML = '<p>Speech recognition not supported in this browser.</p>';
    }
}

function startListening() {
    if (recognition && !isListening && continuousMode) {
        try {
            recognition.start();
        } catch (e) {
            console.error("Error starting recognition:", e);
            setTimeout(() => {
                if (continuousMode) startListening();
            }, 1000);
        }
    }
}

function processVoiceCommand(text) {
    const responseDisplay = document.getElementById('responseDisplay');
    
    responseDisplay.innerHTML = '<p>Processing...</p>';
    
    if (text.toLowerCase().includes('invite principal')) {
        const response = "On behalf of the Association of Intelligent Minds, we warmly invite Dr. C. Mathalai Sundaram, Principal, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite vice principal one')) {
        const response = "On behalf of AIM, we warmly invite Dr. M. Madhavan, Vice Principal, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite vice principal two')) {
        const response = "On behalf of AIM, we warmly invite Dr. M. Sathya, Vice Principal, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite secretary')) {
        const response = "On behalf of AIM, we warmly invite A.S.S.S. Soma Sundaram, Secretary, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite joint secretary')) {
        const response = "On behalf of AIM, we warmly invite Mr. T. Subramani, Joint Secretary, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite hod computer science')) {
        const response = "On behalf of AIM, we warmly invite Dr. J. Mathalai Raj, Head of Computer Science Department, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite hod information technology')) {
        const response = "On behalf of AIM, we warmly invite Mrs. S. Arul Jothi, Head of Information Technology Department, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite hod electrical')) {
        const response = "On behalf of AIM, we warmly invite Dr. R. Athilingam, Head of Electrical Engineering Department, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite hod civil')) {
        const response = "On behalf of AIM, we warmly invite Dr. E. Anantha Krishnan, Head of Civil Engineering Department, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite hod electronics')) {
        const response = "On behalf of AIM, we warmly invite Dr. T. Venishkumar, Head of Electronics and Communication Engineering Department, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite hod artificial intelligence')) {
        const response = "On behalf of AIM, we warmly invite Mr. L.S. Vignesh, Head of Artificial Intelligence Department, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite hod mechanical')) {
        const response = "On behalf of AIM, we warmly invite Dr. B. Radha Krishnan, Head of Mechanical Engineering Department, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('invite hod science and humanities')) {
        const response = "On behalf of AIM, we warmly invite Mr. A. Vembathurajesh, Head of Science and Humanities Department, to our Association Function on 30-08-2025 at 10:30 am in the College Auditorium. It is our honor to have you with us today.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);
        setTimeout(() => { openImageModal(); }, 2000);
    } else if (text.toLowerCase().includes('stop')) {
        continuousMode = false;
        responseDisplay.innerHTML = '<p>Voice assistant stopped. Refresh page to restart.</p>';
        speak("Voice assistant stopped");

    } else if (text.toLowerCase().includes('tell about chief guest') || text.toLowerCase().includes('who is chief guest') || text.toLowerCase().includes('about chief guest') || text.toLowerCase().includes('mr. m. saravanan')) {
        const response = "Our Chief Guest is Mr. M. Saravanan, a Full-stack Developer. He is an accomplished professional in the field of software development and is joining us to share his valuable insights and experience.";
        responseDisplay.innerHTML = `<p>${response}</p>`;
        speak(response);

    } else {
        // Send to Gemini API for all other queries
        fetch("/process", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ text: text })
        })
        .then(res => {
            if (!res.ok) {
                throw new Error(`Server error: ${res.status}`);
            }
            return res.text();
        })
        .then(text => {
            let data;
            try {
                data = JSON.parse(text);
            } catch {
                throw new Error("Invalid JSON response");
            }
            responseDisplay.innerHTML = `<p><strong>You said:</strong> "${text}"</p><p><strong>AI Response:</strong> ${data.reply}</p>`;
            speak(data.reply);
        })
        .catch(error => {
            console.error("API Error:", error);
            const fallbackResponse = "I'm having trouble connecting to my knowledge base. Please try again.";
            responseDisplay.innerHTML = `<p>${fallbackResponse}</p>`;
            speak(fallbackResponse);
        });
    }
}

function speak(text) {
    if ('speechSynthesis' in window) {
        // Cancel any ongoing speech
        speechSynthesis.cancel();
        
        const utterance = new SpeechSynthesisUtterance(text); 
        utterance.rate = 0.9;
        utterance.pitch = 1;
        utterance.volume = 0.8;
        speechSynthesis.speak(utterance);
    }
}

// Image Modal Functions
function openImageModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    const modalContent = modal.querySelector('.modal-content');
    const modalImage = modal.querySelector('.modal-image');
    // Remove any previous iframe
    const oldIframe = modalContent.querySelector('iframe.lottie-iframe');
    if (oldIframe) oldIframe.remove();

    if (imageSrc === 'page.jpg') {
        modalImage.style.display = 'none';
        // Add Lottie iframe
        const iframe = document.createElement('iframe');
        iframe.src = "https://lottie.host/embed/9d02e671-fbfd-4b20-a9ae-012079a687df/eX0tSkWmQW.lottie";
        iframe.className = 'lottie-iframe';
        iframe.style.width = '100%';
        iframe.style.height = '400px';
        iframe.style.border = 'none';
        modalContent.appendChild(iframe);
    } else {
        modalImage.style.display = '';
        // Remove Lottie iframe if present
        const oldIframe2 = modalContent.querySelector('iframe.lottie-iframe');
        if (oldIframe2) oldIframe2.remove();
        if (imageSrc) modalImage.src = imageSrc;
    }
    modal.classList.add('active');
    setTimeout(() => {
        closeImageModal();
    }, 10000); // Close after 10 seconds
}

function closeImageModal() {
    document.getElementById('imageModal').classList.remove('active');
}

// Close modal on click outside
document.getElementById('imageModal').addEventListener('click', (e) => {
    if (e.target === document.getElementById('imageModal')) {
        closeImageModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// Sparkle effect
document.addEventListener('mousemove', (e) => {
    if (Math.random() < 0.05) {
        const sparkle = document.createElement('div');
        sparkle.style.position = 'fixed';
        sparkle.style.left = e.clientX + 'px';
        sparkle.style.top = e.clientY + 'px';
        sparkle.style.width = '4px';
        sparkle.style.height = '4px';
        sparkle.style.background = 'rgba(255, 255, 255, 0.8)';
        sparkle.style.borderRadius = '50%';
        sparkle.style.pointerEvents = 'none';
        sparkle.style.zIndex = '100';
        sparkle.style.animation = 'fadeOut 1s ease forwards';
        document.body.appendChild(sparkle);
        setTimeout(() => sparkle.remove(), 1000);
    }
});


fetch("/process", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ text: text })
})