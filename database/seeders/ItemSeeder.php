<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing items first
        DB::table('items')->truncate();
        
        DB::table('items')->insert([
            [
                'code' => 'La3l44',
                'name' => 'Lael',
                'message' => "Halo el! cewenya jaemin wkwkw. Tengs ya sebelumnya udah bantuin aku selama magang ini, udah sabar ngadepin tingkah laku-ku yang rada absurd wkwkwk. Makasi juga udah sabar sama aku yang pelupa. Makasi buat apapun lah pokoknya banyak yang gabisa aku ungkapin pake kata-kata. Oiya weh jangan lupa tetep bekabar gausa sombong sombong ye walaupun ntar kita udah ga ketemu lagi, kalo mau ajak main jangan sungkan-sungkan. DAN GAUSA TAKUT SAMA ORTU KALO DITANYAIN TENTANG COWO JIR KEK LU UDAH GEDE JIR UDAH PUNYA PILIHAN IDUP MASING-MASING, dh ckp skian. See u on top lael",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'Ki2',
                'name' => 'Kiki',
                'message' => "He kik anjir wes ra ketemu neh (ora deng kan nek aku libur dolan rak si?). Mburi-mburi iki dewe wes ra mangan bareng neh cokkkk -1 life update iki, raono bahan ghibahan neh, gantine kapan-kapan nek koe dolan neng Bandung kabari wae nek aku selo tak samperi gas! Nek ono opo-opo tentang RB po koe cerito wae chat aku mesti tak bales, nek iso tak kei solusi tak kei. Pokoke minimalisir lah drama-drama koyo pas kae wkwkwk. See u on top kik",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'Ref151',
                'name' => 'Reffy',
                'message' => "Semangat reffysi yo ref wkwkwk, mugo wae September iki koe ra demotivasi wkwkwk. Nek koe designan e keteteran ngomong fy ro aku, aku neng kene bukan berarti aku lepas jobdesk ku neng RB aku jek neng RB tapi aku online, dadi nek koe keteteran ngomong wae fy neng aku nek iso tak bantu, mesti tak bantu. See u on top fy, nek we ono dolan neng Doro pas aku jek neng ngomah opo koe moro-moro neng Bandung kabari wae nek aku iso gas yo gas! GLORY GLORY MAN UNITED!!!",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'pre55',
                'name' => 'Ivan',
                'message' => "HIDUP MAHASISWA! HIDUP!!! Halo pres, jo lali solat pres selak di gabyur mega we nek ra solat wkwkwk. Suwun pan segalane, jujur aku pertama ketemu koe segan lek soale aku pertama krungu penggantine Endra presma koyo anjir keren jir, tapi eh jebul... wkwkwk ra pan guyon. Semangatlah nggo koe ben ra ngantukan wkwkwk. See u on top pan",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'Fen11',
                'name' => 'Feni',
                'message' => "Halo pat, eh maksudku fen! WKWKWK SORRY SERING KETUKER. Soale kadang aku ndelok koe cocok tak undang pat nek ipat cocok diundang fen rareti kenopo. Semangat & Selamat deh koe wisudane semoga cita-citamu kesampaian walaupun aku rareti cita-citamu opo (dadi punk?) semoga kecapai deh. See u on top fen",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'pat1pat',
                'name' => 'Ipat',
                'message' => "PATTTTTTTT, KIKI NANGIS DITINGGAL KOE WKWKWKWKKWKWKW. Mesake lek partner e menghilang dari lane secepat kui. 1 Tahun neng jakarta rasah moro-moro ra doyan megono pat. BTW kapan koe bali Jakarta pat? Kiki sudah menunggu buat reuni wkwkwk. Jarene dee sering kelingan koe nek lagi live wkwkwk. Ngko nek koe wes dadi pegawai tetap pertamina (aamiin) ngko ojo lali pat info loker nggo dewe ki. Oiyo, jujur aku ket mbien wes mikir sih wong se-keren koe rabakal mungkin neng RB pat, eh jebul bener koe keterima seng lebih seko RB. see u on top patipat",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'Zah1r4',
                'name' => 'Zahira',
                'message' => "Sopo iki? Aku raono pesan neng koe si zah formalitas tok iki ben ono isi isi (rak zah guyon). Nek mau lael tak omong neng pesan e lanang e jaemin koe sopo? Mark lee? Ah kui lah pokok e rareti K-POP aku. Pokok e terbaik lah nggo koe zah, rasah terlalu dipikir keras soal RB koe ndue kehidupan pribadi seng lebih penting zah, emang tanggung jawabmu tapi ileng dewe ra di bayar wkwkwk dadi rasah terlalu dipikir nemen-nemen (rak-rak guyon tapi keren sih koe all in nemen nggo RB sampe extend wkwkwk). Suwun wes ngebimbing batch 6 neng RB wes ngekei dewe reti does don't e opo wae neng RB. Seeu on top zah!",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'Me3G4',
                'name' => 'Mega',
                'message' => "Decul, decul. Omongi ipan ben shalat meg di sisa-sisa waktu dee neng RB meh gabyur nek dee ra gelem shalat wkwkwk. Suwun meg segalane, saiki aku reti jebul ono seng jeneng e Mega neng Doro wkwkwk sak urunge aku ra kenal samsek lek ro koe padahal 1 desa wkwkwk. Pokok e doa terbaik nggo koe meg! See u on top meggg!",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'Lang',
                'name' => 'Gilang',
                'message' => "Lorem ipsum",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
        $this->command->info('Items seeded successfully with all data!');
        $this->command->info('Total items created: ' . count(DB::table('items')->get()));
    }
}