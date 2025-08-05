<footer class="footer">
  <p>&copy; 2025 CodeMart. All rights reserved.
  <p>Rekayasa Perangkat Lunak - SMK Dinamika Pembangunan 2 Jakarta</p>
  </p>


  <div class="social-icons">
    <a href="+6281212643792"><img src="https://img.icons8.com/ios-filled/50/000000/whatsapp.png" alt="WhatsApp"></a>
    <a href="https://www.instagram.com/codemarketdp2/"><img src="https://img.icons8.com/ios-filled/50/000000/instagram-new.png" alt="Instagram"></a>
  </div>

  <div class="map-container">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5460897738285!2d106.93475497475028!3d-6.191436193796184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698b69927a4509%3A0x12f6165c1156d75c!2sSMK%20Dinamika%20Pembangunan%202%20Jakarta!5e0!3m2!1sid!2sid!4v1754197593237!5m2!1sid!2sid" 
      width="600" 
      height="300" 
      style="border:0;" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</footer>

<style>
.footer {
  background: var(--dark);
  color: var(--secondary);
  text-align: center;
  padding: 20px;
  margin-top: 40px;
  position: relative;
}

.footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 10px;
  background: linear-gradient(to right, var(--primary), var(--secondary));
}

.footer p {
  margin: 4px 0;
  font-size: 18px;
}

.social-icons {
  display: flex;
  justify-content: center;
  gap: 1.5rem;
  margin: 1.2rem 0;
}

.social-icons a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: rgba(255, 238, 169, 0.2);
  transition: all 0.3s ease;
}

.social-icons a:hover {
  background: var(--primary);
  transform: translateY(-5px);
}

.social-icons img {
  width: 30px;
  height: 30px;
  object-fit: contain;
}

.map-container {
  max-width: 100%;
  overflow: hidden;
  display: flex;
  justify-content: center;
  margin-top: 1.5rem;
}

.map-container iframe {
  width: 100%;
  max-width: 600px;
  height: 300px;
  border-radius: 10px;
  box-shadow: var(--shadow);
}

</style>
