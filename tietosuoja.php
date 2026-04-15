body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #0f172a;
    color: #e5e7eb;
}

.navbar {
    background: #020617;
    padding: 14px 18px;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    border-bottom: 1px solid #1e293b;
}

.navbar a {
    color: #e5e7eb;
    text-decoration: none;
    padding: 8px 14px;
    border-radius: 10px;
    background: #1e293b;
    transition: 0.2s;
}

.navbar a:hover {
    background: #2563eb;
}

.container, .box {
    max-width: 720px;
    margin: 30px auto;
    background: #020617;
    border: 1px solid #1e293b;
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.4);
}

h1, h2, h3, h4 {
    margin-top: 0;
    color: #f1f5f9;
}

input, select, textarea, button {
    font: inherit;
}

input[type=text],
input[type=password],
select,
textarea {
    width: min(100%, 420px);
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #334155;
    background: #0f172a;
    color: white;
    outline: none;
}

textarea {
    width: min(100%, 620px);
    min-height: 120px;
}

input[type=submit],
button {
    border: none;
    border-radius: 10px;
    background: #2563eb;
    color: white;
    padding: 10px 16px;
    cursor: pointer;
    transition: 0.2s;
}

input[type=submit]:hover,
button:hover {
    background: #1d4ed8;
}

.lista p {
    margin: 8px 0;
}

.ingredient-row {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
    flex-wrap: wrap;
}

p {
    color: #cbd5f5;
}