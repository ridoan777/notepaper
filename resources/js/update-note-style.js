window.MyApp = window.MyApp || {};

window.MyApp.utils = {
	// ------------------
	updateFontFamily(fontName) {
		const textarea = document.querySelector('.notepad_textarea');
		const input = document.querySelector('.font_family_input');
		if (textarea) {
			textarea.style.fontFamily = fontName;
			input.value = fontName;

			input.dispatchEvent(new Event('input', { bubbles: true }));
		}
	},
	// ------------------
	updateFontSize(size) {
		const textarea = document.querySelector('.notepad_textarea');
		const input = document.querySelector('.font_size_input');
		if (textarea) {
			textarea.style.fontSize = size;
			input.value = size;

			input.dispatchEvent(new Event('input', { bubbles: true }));
		}
	},
	// ------------------
	updateLineHeight(size) {
		const textarea = document.querySelector('.notepad_textarea');
		const input = document.querySelector('.line_height_input');
		if (textarea) {
			textarea.style.lineHeight = size;
			input.value = size;

			input.dispatchEvent(new Event('input', { bubbles: true }));
		}
	},
	// ------------------
	getTextCopied() {
		const textarea = document.querySelector('.notepad_textarea');
		const copyButton = document.getElementById('copyButton');
		const copyButtonOriginal = document.getElementById('copyButton').innerHTML;

		if (navigator.clipboard) {
			navigator.clipboard.writeText(textarea.value)
				.then(() => {
					copyButton.style.fontSize = "14px";
					copyButton.innerHTML = "Copied ✅";
					setTimeout(() => {
						copyButton.innerHTML = copyButtonOriginal;
					}, 5000);
				})
				.catch(err => {
					console.error("Failed to copy: ", err);
					copyButton.innerHTML = "Failed ❌";
				});
		} else {
			// Fallback for older browsers
			textarea.select();
			textarea.setSelectionRange(0, 99999); // iOS support
			document.execCommand("copy");
			copyButton.innerHTML = "Copied ✅";
		}
	},
	// ------------------
	hideMessageArea: function () {
		setTimeout(function () {
			const msg = document.getElementById('messageArea');
			if (msg) {
				msg.classList.add('transition-opacity', 'duration-1000', 'opacity-0');
				setTimeout(() => {
					msg.style.display = 'none';
				}, 1000); // fade-out finishes in 1s
			}
		}, 10000); // wait 10s before fading
	}

};

function initNotePageFeatures() {
	const fontFamilySelect = document.getElementById('updateFontFamily');
	const fontSizeSelect = document.getElementById('updateFontSize');
	const lineHeightSelect = document.getElementById('updateLineHeight');
	const copyButtonSelect = document.getElementById('copyButton');

	if (fontFamilySelect) {
		fontFamilySelect.addEventListener('change', function () {
			const selectedFont = fontFamilySelect.value;
			if (selectedFont) {
				window.MyApp.utils.updateFontFamily(selectedFont);
			}
		});
	}
	// ------------------
	if (fontSizeSelect) {
		fontSizeSelect.addEventListener('change', function () {
			const selectedSize = fontSizeSelect.value;
			if (selectedSize) {
				window.MyApp.utils.updateFontSize(selectedSize);
			}
		});
	}
	// ------------------
	if (lineHeightSelect) {
		lineHeightSelect.addEventListener('change', function () {
			const selectedLineHeight = lineHeightSelect.value;
			if (selectedLineHeight) {
				window.MyApp.utils.updateLineHeight(selectedLineHeight);
			}
		});
	}
	// ------------------
	if(copyButtonSelect) {
		copyButtonSelect.addEventListener('click', function () {
			window.MyApp.utils.getTextCopied();
		})
	}
	// ------------------
	window.MyApp.utils.hideMessageArea();

}

document.addEventListener('DOMContentLoaded', initNotePageFeatures);
document.addEventListener('livewire:navigated', initNotePageFeatures);
document.addEventListener('livewire:load', initNotePageFeatures);
document.addEventListener('livewire:update', initNotePageFeatures);