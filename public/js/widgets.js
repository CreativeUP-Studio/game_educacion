/**
 * TrignoQuest - Interactive Widgets
 * Canvas-based trigonometry visualizations.
 */
(function() {
    'use strict';

    document.querySelectorAll('.interactive-widget').forEach(widget => {
        const type = widget.dataset.widget;
        const canvas = widget.querySelector('canvas');
        const slider = widget.querySelector('input[type="range"]');
        const valueDisplay = widget.querySelector('.widget-value');

        if (!canvas) return;
        const ctx = canvas.getContext('2d');

        // High DPI
        const dpr = window.devicePixelRatio || 1;
        const rect = canvas.getBoundingClientRect();
        canvas.width = 500 * dpr;
        canvas.height = 400 * dpr;
        ctx.scale(dpr, dpr);

        const W = 500, H = 400;

        function draw(angleDeg) {
            ctx.clearRect(0, 0, W, H);

            switch (type) {
                case 'angle-explorer':
                    drawAngleExplorer(ctx, angleDeg, W, H);
                    break;
                case 'sohcahtoa-explorer':
                    drawSOHCAHTOA(ctx, angleDeg, W, H);
                    break;
                case 'pythagoras-explorer':
                    drawPythagoras(ctx, angleDeg, W, H);
                    break;
                default:
                    drawAngleExplorer(ctx, angleDeg, W, H);
            }
        }

        if (slider) {
            slider.addEventListener('input', () => {
                const angle = parseInt(slider.value);
                if (valueDisplay) valueDisplay.textContent = angle + '°';
                draw(angle);
            });
        }

        draw(45);
    });

    function drawAngleExplorer(ctx, angleDeg, W, H) {
        const cx = W / 2, cy = H / 2 + 30;
        const radius = 140;
        const angleRad = angleDeg * Math.PI / 180;

        // Background circle
        ctx.beginPath();
        ctx.arc(cx, cy, radius, 0, Math.PI * 2);
        ctx.strokeStyle = 'rgba(108, 99, 255, 0.2)';
        ctx.lineWidth = 2;
        ctx.stroke();

        // Horizontal line
        ctx.beginPath();
        ctx.moveTo(cx - radius - 20, cy);
        ctx.lineTo(cx + radius + 20, cy);
        ctx.strokeStyle = 'rgba(255,255,255,0.15)';
        ctx.lineWidth = 1;
        ctx.stroke();

        // Angle arc
        ctx.beginPath();
        ctx.arc(cx, cy, 50, 0, -angleRad, true);
        ctx.strokeStyle = '#00D4FF';
        ctx.lineWidth = 3;
        ctx.stroke();

        // First ray (horizontal)
        ctx.beginPath();
        ctx.moveTo(cx, cy);
        ctx.lineTo(cx + radius, cy);
        ctx.strokeStyle = '#6C63FF';
        ctx.lineWidth = 3;
        ctx.stroke();

        // Second ray (at angle)
        const ex = cx + radius * Math.cos(-angleRad);
        const ey = cy + radius * Math.sin(-angleRad);
        ctx.beginPath();
        ctx.moveTo(cx, cy);
        ctx.lineTo(ex, ey);
        ctx.strokeStyle = '#FF6B9D';
        ctx.lineWidth = 3;
        ctx.stroke();

        // Endpoint dot
        ctx.beginPath();
        ctx.arc(ex, ey, 6, 0, Math.PI * 2);
        ctx.fillStyle = '#FF6B9D';
        ctx.fill();

        // Angle label
        const labelDist = 70;
        const labelAngle = -angleRad / 2;
        ctx.font = 'bold 18px Nunito';
        ctx.fillStyle = '#00D4FF';
        ctx.textAlign = 'center';
        ctx.fillText(angleDeg + '°', cx + labelDist * Math.cos(labelAngle), cy + labelDist * Math.sin(labelAngle));

        // Classification
        let classification = '';
        let color = '#e8e6f0';
        if (angleDeg === 0) { classification = 'Sin ángulo'; color = '#a0a0c0'; }
        else if (angleDeg < 90) { classification = 'Ángulo Agudo'; color = '#00E676'; }
        else if (angleDeg === 90) { classification = 'Ángulo Recto'; color = '#00D4FF'; }
        else if (angleDeg < 180) { classification = 'Ángulo Obtuso'; color = '#FFA502'; }
        else if (angleDeg === 180) { classification = 'Ángulo Llano'; color = '#FF6B9D'; }
        else if (angleDeg < 360) { classification = 'Ángulo Reflejo'; color = '#FF4757'; }
        else { classification = 'Ángulo Completo'; color = '#6C63FF'; }

        ctx.font = 'bold 22px "Fredoka One", cursive';
        ctx.fillStyle = color;
        ctx.textAlign = 'center';
        ctx.fillText(classification, cx, 40);

        // Right angle mark
        if (angleDeg === 90) {
            ctx.beginPath();
            ctx.moveTo(cx + 20, cy);
            ctx.lineTo(cx + 20, cy - 20);
            ctx.lineTo(cx, cy - 20);
            ctx.strokeStyle = '#00D4FF';
            ctx.lineWidth = 2;
            ctx.stroke();
        }
    }

    function drawSOHCAHTOA(ctx, angleDeg, W, H) {
        const margin = 60;
        const maxSide = 250;
        const angleRad = Math.max(5, Math.min(85, angleDeg)) * Math.PI / 180;

        // Triangle dimensions
        const adj = maxSide * Math.cos(angleRad);
        const opp = maxSide * Math.sin(angleRad);

        const bx = margin, by = H - margin;
        const cx2 = bx + adj, cy2 = by;
        const ax = bx + adj, ay = by - opp;

        // Fill triangle
        ctx.beginPath();
        ctx.moveTo(bx, by);
        ctx.lineTo(cx2, cy2);
        ctx.lineTo(ax, ay);
        ctx.closePath();
        ctx.fillStyle = 'rgba(108, 99, 255, 0.08)';
        ctx.fill();

        // Draw sides
        // Hypotenuse
        ctx.beginPath();
        ctx.moveTo(bx, by); ctx.lineTo(ax, ay);
        ctx.strokeStyle = '#FFD93D';
        ctx.lineWidth = 3;
        ctx.stroke();

        // Adjacent (bottom)
        ctx.beginPath();
        ctx.moveTo(bx, by); ctx.lineTo(cx2, cy2);
        ctx.strokeStyle = '#00D4FF';
        ctx.lineWidth = 3;
        ctx.stroke();

        // Opposite (right side)
        ctx.beginPath();
        ctx.moveTo(cx2, cy2); ctx.lineTo(ax, ay);
        ctx.strokeStyle = '#FF6B9D';
        ctx.lineWidth = 3;
        ctx.stroke();

        // Right angle mark
        const rSize = 15;
        ctx.beginPath();
        ctx.moveTo(cx2 - rSize, cy2);
        ctx.lineTo(cx2 - rSize, cy2 - rSize);
        ctx.lineTo(cx2, cy2 - rSize);
        ctx.strokeStyle = 'rgba(255,255,255,0.4)';
        ctx.lineWidth = 2;
        ctx.stroke();

        // Angle arc
        ctx.beginPath();
        ctx.arc(bx, by, 35, -angleRad, 0);
        ctx.strokeStyle = '#00E676';
        ctx.lineWidth = 2;
        ctx.stroke();

        // Labels
        ctx.font = 'bold 16px Nunito';
        ctx.textAlign = 'center';

        // Angle label
        ctx.fillStyle = '#00E676';
        ctx.fillText('θ = ' + Math.max(5, Math.min(85, angleDeg)) + '°', bx + 55, by - 15);

        // Side labels
        const sinVal = Math.sin(angleRad).toFixed(3);
        const cosVal = Math.cos(angleRad).toFixed(3);
        const tanVal = (Math.sin(angleRad) / Math.cos(angleRad)).toFixed(3);

        // Hypotenuse
        const hx = (bx + ax) / 2 - 30, hy = (by + ay) / 2;
        ctx.fillStyle = '#FFD93D';
        ctx.fillText('H', hx, hy);

        // Adjacent
        ctx.fillStyle = '#00D4FF';
        ctx.fillText('A (Adyacente)', (bx + cx2) / 2, by + 25);

        // Opposite
        ctx.fillStyle = '#FF6B9D';
        ctx.save();
        ctx.translate(cx2 + 25, (cy2 + ay) / 2);
        ctx.fillText('O', 0, 0);
        ctx.fillText('(Opuesto)', 0, 18);
        ctx.restore();

        // Values box
        const boxX = W - 200, boxY = 20;
        ctx.fillStyle = 'rgba(255,255,255,0.05)';
        ctx.fillRect(boxX, boxY, 180, 110);
        ctx.strokeStyle = 'rgba(108, 99, 255, 0.3)';
        ctx.lineWidth = 1;
        ctx.strokeRect(boxX, boxY, 180, 110);

        ctx.font = 'bold 14px Nunito';
        ctx.textAlign = 'left';
        ctx.fillStyle = '#6C63FF';
        ctx.fillText('Sen θ = O/H = ' + sinVal, boxX + 12, boxY + 30);
        ctx.fillStyle = '#00D4FF';
        ctx.fillText('Cos θ = A/H = ' + cosVal, boxX + 12, boxY + 60);
        ctx.fillStyle = '#FF6B9D';
        ctx.fillText('Tan θ = O/A = ' + tanVal, boxX + 12, boxY + 90);
    }

    function drawPythagoras(ctx, angleDeg, W, H) {
        // Use angle to control side 'a' from 1 to 12
        const a = Math.max(1, Math.round((angleDeg / 360) * 12));
        const b = Math.max(1, Math.round(12 - a * 0.5));
        const c = Math.sqrt(a * a + b * b);

        const scale = 20;
        const margin = 80;

        const bx = margin, by = H - margin;
        const cx2 = bx + b * scale, cy2 = by;
        const ax = cx2, ay = by - a * scale;

        // Fill triangle
        ctx.beginPath();
        ctx.moveTo(bx, by);
        ctx.lineTo(cx2, cy2);
        ctx.lineTo(ax, ay);
        ctx.closePath();
        ctx.fillStyle = 'rgba(108, 99, 255, 0.06)';
        ctx.fill();

        // Draw sides with thickness proportional to value
        // Side a (vertical)
        ctx.beginPath();
        ctx.moveTo(cx2, cy2); ctx.lineTo(ax, ay);
        ctx.strokeStyle = '#FF6B9D';
        ctx.lineWidth = 3;
        ctx.stroke();

        // Side b (horizontal)
        ctx.beginPath();
        ctx.moveTo(bx, by); ctx.lineTo(cx2, cy2);
        ctx.strokeStyle = '#00D4FF';
        ctx.lineWidth = 3;
        ctx.stroke();

        // Side c (hypotenuse)
        ctx.beginPath();
        ctx.moveTo(bx, by); ctx.lineTo(ax, ay);
        ctx.strokeStyle = '#FFD93D';
        ctx.lineWidth = 3;
        ctx.stroke();

        // Right angle mark
        const rSize = 12;
        ctx.beginPath();
        ctx.moveTo(cx2 - rSize, cy2);
        ctx.lineTo(cx2 - rSize, cy2 - rSize);
        ctx.lineTo(cx2, cy2 - rSize);
        ctx.strokeStyle = 'rgba(255,255,255,0.4)';
        ctx.lineWidth = 2;
        ctx.stroke();

        // Labels
        ctx.font = 'bold 16px Nunito';
        ctx.textAlign = 'center';

        ctx.fillStyle = '#FF6B9D';
        ctx.fillText('a = ' + a, cx2 + 30, (cy2 + ay) / 2);

        ctx.fillStyle = '#00D4FF';
        ctx.fillText('b = ' + b, (bx + cx2) / 2, by + 25);

        ctx.fillStyle = '#FFD93D';
        const hx = (bx + ax) / 2 - 35, hy = (by + ay) / 2;
        ctx.fillText('c = ' + c.toFixed(2), hx, hy);

        // Formula
        ctx.font = 'bold 22px "Fredoka One", cursive';
        ctx.fillStyle = '#e8e6f0';
        ctx.textAlign = 'center';
        ctx.fillText('a² + b² = c²', W / 2, 40);

        ctx.font = 'bold 16px Nunito';
        ctx.fillStyle = '#00D4FF';
        ctx.fillText(`${a}² + ${b}² = ${a*a} + ${b*b} = ${a*a + b*b}`, W / 2, 70);

        ctx.fillStyle = '#FFD93D';
        ctx.fillText(`c = √${a*a + b*b} = ${c.toFixed(2)}`, W / 2, 95);

        // Verification check
        const cSquared = a * a + b * b;
        ctx.font = 'bold 14px Nunito';
        ctx.fillStyle = '#00E676';
        ctx.fillText(`✓ ${c.toFixed(2)}² = ${(c*c).toFixed(1)} ≈ ${cSquared}`, W / 2, 120);

        // Draw small squares on sides (visual Pythagorean proof)
        ctx.globalAlpha = 0.15;

        // Square on side a
        ctx.fillStyle = '#FF6B9D';
        ctx.fillRect(cx2, ay, a * scale, a * scale);

        // Square on side b
        ctx.fillStyle = '#00D4FF';
        ctx.fillRect(bx, by, b * scale, -b * scale);

        ctx.globalAlpha = 1;
    }
})();
