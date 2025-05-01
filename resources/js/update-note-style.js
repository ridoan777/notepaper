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
		if (textarea && input) {
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
	updateGroup(name) {
		const input = document.querySelector('.group_input');
		if (input) {
			input.value = name;

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
					copyButton.style.color = "dodgerblue";
					setTimeout(() => {
						copyButton.innerHTML = copyButtonOriginal;
					}, 5000);
				})
				.catch(err => {
					console.error("Failed to copy: ", err);
					copyButton.innerHTML = "Copy Failed ❌";
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
	deleleNote(){
		const deleteBtn = document.getElementById('deleteNote');

		if(deleteBtn){
			const newDeleteBtn = deleteBtn.cloneNode(true);
				// removing existing listeners preventing duplication
      	deleteBtn.parentNode.replaceChild(newDeleteBtn, deleteBtn);

			newDeleteBtn.addEventListener('click', function(e) {
				e.preventDefault();
				if (confirm("Are you sure you want to delete this note?")) {
				  window.location.href = newDeleteBtn.href;
				}
			});
		}
	}

};

window.MyApp.utils.alertMssgArea = function () {

	const msg = document.getElementById('messageArea');

	if (!msg) return;

	function fadeOut() {
		if (msg.textContent.trim() !== "") {
			// Reset visibility
			msg.style.display = 'block';
			msg.classList.remove('opacity-0');

			// Trigger fade-out after 10 seconds
			setTimeout(() => {
				msg.classList.add('transition-opacity', 'duration-1000', 'opacity-0');
				setTimeout(() => {
					msg.style.display = 'none';
				}, 1000); // Fade-out duration
			}, 10000);
		}
	}

	// Initial fade
	fadeOut();

	// Observe DOM changes for Livewire updates
	const observer = new MutationObserver(() => {
		fadeOut();
	});

	observer.observe(msg, { childList: true, subtree: true });

	// Also re-trigger on Livewire events
	document.addEventListener('livewire:update', fadeOut);
	document.addEventListener('livewire:load', fadeOut);
};


function initNotePageFeatures() {
	const copyButtonSelect = document.getElementById('copyButton');
	const fontFamilySelect = document.getElementById('updateFontFamily');
	const fontSizeSelect = document.getElementById('updateFontSize');
	const lineHeightSelect = document.getElementById('updateLineHeight');
	const updateGroup = document.getElementById('updateGroup');

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
	if (updateGroup) {
		updateGroup.addEventListener('change', function () {
			const selectedUpdateGroup = updateGroup.value;
			if (selectedUpdateGroup) {
				window.MyApp.utils.updateGroup(selectedUpdateGroup);
			}
		});
	}
	// ------------------
	if (copyButtonSelect) {
		copyButtonSelect.addEventListener('click', function () {
			window.MyApp.utils.getTextCopied();
		})
	}
	// ------------------
	MyApp.utils.alertMssgArea();
	window.MyApp.utils.deleleNote();

}

document.addEventListener('DOMContentLoaded', initNotePageFeatures);
document.addEventListener('livewire:navigated', initNotePageFeatures);
document.addEventListener('livewire:load', initNotePageFeatures);
document.addEventListener('livewire:update', initNotePageFeatures);