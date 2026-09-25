// Generates Grid & Grain's sample products: geometric art prints drawn as SVG.
// Deterministic per seed, so every capture shows the same prints.
window.printArt = function (seed, w = 400, h = 500) {
    let s = seed * 9301 + 49297;
    const rand = () => ((s = (s * 9301 + 49297) % 233280) / 233280);
    const palettes = [
        ['#F2E9DC', '#D96C47', '#2F6F6A', '#E3B04B', '#1E1B18'],
        ['#EDE6F2', '#5B4B8A', '#E07A5F', '#F2CC8F', '#1E1B18'],
        ['#E8EFEA', '#1F5F4A', '#E9C46A', '#E76F51', '#16211D'],
        ['#F4EDE4', '#264653', '#2A9D8F', '#F4A261', '#1E1B18'],
        ['#F6F1E9', '#B5838D', '#6D6875', '#E5989B', '#22223B'],
    ];
    const [bg, a, b, c, ink] = palettes[seed % palettes.length];
    const pick = () => [a, b, c, ink][Math.floor(rand() * 4)];
    let out = `<rect width="${w}" height="${h}" fill="${bg}"/>`;
    const kind = seed % 4;
    if (kind === 0) {
        out += `<circle cx="${w * 0.5}" cy="${h * 0.42}" r="${w * 0.3}" fill="${a}"/>`;
        out += `<rect x="0" y="${h * 0.62}" width="${w}" height="${h * 0.38}" fill="${b}"/>`;
        out += `<path d="M${w * 0.2} ${h * 0.62} A${w * 0.3} ${w * 0.3} 0 0 1 ${w * 0.8} ${h * 0.62}Z" fill="${c}"/>`;
    } else if (kind === 1) {
        for (let i = 0; i < 6; i++) out += `<rect x="${i * w / 6}" y="0" width="${w / 12}" height="${h}" fill="${i % 2 ? a : b}" opacity="${0.55 + rand() * 0.45}"/>`;
        out += `<circle cx="${w * 0.62}" cy="${h * 0.36}" r="${w * 0.2}" fill="${c}"/>`;
        out += `<rect x="${w * 0.14}" y="${h * 0.66}" width="${w * 0.52}" height="${h * 0.12}" fill="${ink}"/>`;
    } else if (kind === 2) {
        for (let i = 0; i < 5; i++) out += `<circle cx="${w * 0.5}" cy="${h * 0.5}" r="${w * (0.45 - i * 0.085)}" fill="${[a, bg, b, bg, c][i]}"/>`;
        out += `<rect x="${w * 0.5}" y="0" width="${w * 0.5}" height="${h}" fill="${bg}" opacity=".35"/>`;
    } else {
        out += `<rect x="${w * 0.12}" y="${h * 0.1}" width="${w * 0.46}" height="${h * 0.5}" fill="${a}"/>`;
        out += `<rect x="${w * 0.42}" y="${h * 0.36}" width="${w * 0.46}" height="${h * 0.5}" fill="${b}" opacity=".9"/>`;
        out += `<circle cx="${w * 0.3}" cy="${h * 0.74}" r="${w * 0.12}" fill="${pick()}"/>`;
        out += `<path d="M${w * 0.62} ${h * 0.1} L${w * 0.88} ${h * 0.1} L${w * 0.88} ${h * 0.3}Z" fill="${c}"/>`;
    }
    return `<svg viewBox="0 0 ${w} ${h}" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" class="block h-full w-full">${out}</svg>`;
};

window.PRINTS = [
    ['Harbour Noon', 'Abstract', 48], ['Kiln Study', 'Abstract', 42], ['Five Rings', 'Geometric', 55], ['Terrace', 'Architecture', 48],
    ['Low Tide', 'Abstract', 39], ['Orchard Grid', 'Geometric', 45], ['Signal', 'Geometric', 52], ['Late Bloom', 'Botanical', 44],
];
