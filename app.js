document.addEventListener('DOMContentLoaded', () => {

    // --- 1. FUNCIÓN DE MOSTRAR / OCULTAR CONTRASEÑA (OJITO) ---
    const togglePassBtn = document.getElementById('toggle-pass-btn');
    const inputPassAdmin = document.getElementById('pass_admin');

    if (togglePassBtn && inputPassAdmin) {
        togglePassBtn.addEventListener('click', () => {
            const esPassword = inputPassAdmin.type === 'password';
            inputPassAdmin.type = esPassword ? 'text' : 'password';
            togglePassBtn.textContent = esPassword ? '🙈' : '👁️';
        });
    }

    // --- 2. VALIDACIÓN DE CONTRASEÑA DE ADMINISTRADOR ---
    const btnLoginAdmin = document.getElementById('btn-login-admin');
    const globalLockScreen = document.getElementById('global-lock-screen');
    const adminProtectedArea = document.getElementById('admin-protected-area');
    const errorPass = document.getElementById('error-pass');

    function validarAccesoAdmin() {
        if (!inputPassAdmin) return;

        // Convierte a minúsculas y remueve espacios sobrantes
        const claveIngresada = inputPassAdmin.value.trim().toLowerCase();

        if (claveIngresada === "chef candia") {
            globalLockScreen.style.display = 'none';
            adminProtectedArea.style.display = 'block';
            errorPass.style.display = 'none';
        } else {
            errorPass.style.display = 'block';
            inputPassAdmin.value = '';
            inputPassAdmin.focus();
        }
    }

    if (btnLoginAdmin) {
        btnLoginAdmin.onclick = validarAccesoAdmin;
    }

    if (inputPassAdmin) {
        inputPassAdmin.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                validarAccesoAdmin();
            }
        });
    }

    // --- 3. CONTROL DE PESTAÑAS ADMINISTRATIVAS ---
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');

            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            button.classList.add('active');
            const targetSection = document.getElementById(tabId);
            if (targetSection) {
                targetSection.classList.add('active');
            }
        });
    });

    // --- 4. CÁLCULO DINÁMICO DE TOTALES EN PEDIDOS ---
    const selectProducto = document.getElementById('select_producto');
    const inputCantidad = document.getElementById('cant_producto');
    const inputPrecioUnitario = document.getElementById('precio_unitario');
    const displayTotal = document.getElementById('total_pedido');
    const inputTotal = document.getElementById('input_total');

    function calcularTotal() {
        if (!selectProducto || !inputCantidad) return;
        
        const optionSeleccionada = selectProducto.options[selectProducto.selectedIndex];
        const precio = parseFloat(optionSeleccionada.getAttribute('data-precio')) || 0;
        const cantidad = parseInt(inputCantidad.value) || 1;

        const total = precio * cantidad;

        if (inputPrecioUnitario) inputPrecioUnitario.value = precio.toFixed(2);
        if (displayTotal) displayTotal.textContent = `$${total.toFixed(2)} MXN`;
        if (inputTotal) inputTotal.value = total.toFixed(2);
    }

    if (selectProducto && inputCantidad) {
        selectProducto.addEventListener('change', calcularTotal);
        inputCantidad.addEventListener('input', calcularTotal);
    }
});