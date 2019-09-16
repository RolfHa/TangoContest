# TangoContest
Tanzbewertungssoftware
Diese Software dient exemplarisch dem Lernen von Softwareprojekten und
der Benutzung von Git







info_ronda

SELECT
tanzpaar2kategorie.tanzpaar_id AS tanzpaar_id,
tanzpaar.startnummer AS startnummer,
tanzpaar.fuehrungsfolge AS fuehrungsfolge,
tanzpaar.teilnehmer1_id AS teilnehmer1_id,
teilnehmer1.vorname AS teilnehmer1vorname,
teilnehmer1.nachname AS teilnehmer1nachname,
teilnehmer1.wohnort AS teilnehmer1wohnort,
teilnehmer1.wohnland AS teilnehmer1wohnland,
teilnehmer1.kuenstlername AS teilnehmer1kuenstlername,
teilnehmer1.geburtsname AS teilnehmer1geburtsname,
tanzpaar.teilnehmer2_id AS teilnehmer2_id,
teilnehmer2.vorname AS teilnehmer2vorname,
teilnehmer2.nachname AS teilnehmer2nachname,
teilnehmer2.wohnort AS teilnehmer2wohnort,
teilnehmer1.wohnland AS teilnehmer2wohnland,
teilnehmer2.kuenstlername AS teilnehmer2kuenstlername,
teilnehmer2.geburtsname AS teilnehmer2geburtsname,
tanzpaar2kategorie.kategorie_id AS kategorie_id,
kategorie.kategorie AS kategorie,
ronda.stufe_id AS stufe_id,
stufe.stufe AS stufe,
ronda.id AS ronda_id,
ronda.ronda AS ronda,
tanzpaar2ronda.reihenfolge AS reihenfolge,
jury.id AS jury_id,
jury.vorname AS juryvorname,
jury.nachname AS jurynachname
from tanzpaar2ronda
left join ronda ON ronda.id = tanzpaar2ronda.ronda_id
left join jury2ronda on jury2ronda.ronda_id = tanzpaar2ronda.ronda_id
left join jury on jury2ronda.jury_id = jury.id
join tanzpaar2kategorie on tanzpaar2kategorie.id = tanzpaar2ronda.tanzpaar2kategorie_id
join stufe on stufe.id = ronda.stufe_id
join kategorie ON kategorie.id = ronda.kategorie_id
join tanzpaar on tanzpaar.id = tanzpaar2kategorie.tanzpaar_id
join teilnehmer teilnehmer1 on teilnehmer1.id = tanzpaar.teilnehmer1_id
join teilnehmer teilnehmer2 on teilnehmer2.id = tanzpaar.teilnehmer2_id
order by tango.kategorie.id ,tango.stufe.id , ronda.ronda, tanzpaar2ronda.reihenfolge




info_tanzpaar

SELECT
tanzpaar.id AS tanzpaar_id,
tanzpaar.startnummer AS startnummer,
tanzpaar.fuehrungsfolge AS fuehrungsfolge,
tanzpaar.teilnehmer1_id AS teilnehmer1_id,
teilnehmer1.vorname AS teilnehmer1vorname,
teilnehmer1.nachname AS teilnehmer1nachname,
teilnehmer1.wohnort AS teilnehmer1wohnort,
teilnehmer1.wohnland AS teilnehmer1wohnland,
teilnehmer1.kuenstlername AS teilnehmer1kuenstlername,
teilnehmer1.geburtsname AS teilnehmer1geburtsname,
tanzpaar.teilnehmer2_id AS teilnehmer2_id,
teilnehmer2.vorname AS teilnehmer2vorname,
teilnehmer2.nachname AS teilnehmer2nachname,
teilnehmer2.wohnort AS teilnehmer2wohnort,
teilnehmer1.wohnland AS teilnehmer2wohnland,
teilnehmer2.kuenstlername AS teilnehmer2kuenstlername,
teilnehmer2.geburtsname AS teilnehmer2geburtsname,
tanzpaar.anmeldebetrag AS anmeldebetrag,
tanzpaar.bezahlt AS bezahlt,
tanzpaar.bezahlart_id AS bezahlart_id,
bezahlart.bezahlart AS bezahlart,
tanzpaar.bezahldatum AS bezahldatum
from tanzpaar
join teilnehmer teilnehmer1 on teilnehmer1.id = tanzpaar.teilnehmer1_id
join teilnehmer teilnehmer2 on teilnehmer2.id = tanzpaar.teilnehmer2_id
join bezahlart on bezahlart.id = tanzpaar.bezahlart_id
order by tanzpaar.startnummer


info_punkte

SELECT
 tanzpaar2kategorie.tanzpaar_id AS tanzpaar_id,
 tanzpaar.startnummer AS startnummer,
 tanzpaar.fuehrungsfolge AS fuehrungsfolge,
 tanzpaar.teilnehmer1_id AS teilnehmer1_id,
 teilnehmer1.vorname AS teilnehmer1vorname,
 teilnehmer1.nachname AS teilnehmer1nachname,
 teilnehmer1.wohnort AS teilnehmer1wohnort,
 teilnehmer1.wohnland AS teilnehmer1wohnland,
 teilnehmer1.kuenstlername AS teilnehmer1kuenstlername,
 teilnehmer1.geburtsname AS teilnehmer1geburtsname,
 tanzpaar.teilnehmer2_id AS teilnehmer2_id,
 teilnehmer2.vorname AS teilnehmer2vorname,
 teilnehmer2.nachname AS teilnehmer2nachname,
 teilnehmer2.wohnort AS teilnehmer2wohnort,
 teilnehmer1.wohnland AS teilnehmer2wohnland,
 teilnehmer2.kuenstlername AS teilnehmer2kuenstlername,
 teilnehmer2.geburtsname AS teilnehmer2geburtsname,
 kategorie.id AS kategorie_id,
 kategorie.kategorie AS kategorie,
 stufe.id AS stufe_id,
 stufe.stufe AS stufe,
 kategorie2stufe.id AS kategorie2stufe_id,
 ronda.id AS ronda_id,
 ronda.ronda AS ronda,
 reihenfolge AS reihenfolge,
 punkte.tanzpaar2ronda_id as tanzpaar2ronda_id,
 punkte AS punkte,
 punkte.id AS punkte_id,
 punkte.jury_id AS jury_id,
 jury.vorname AS juryvorname,
 jury.nachname AS jurynachname
 from punkte
 join jury on jury.id = tango.punkte.jury_id
 join tanzpaar2ronda on tanzpaar2ronda.id = punkte.tanzpaar2ronda_id
 join ronda on ronda.id = tanzpaar2ronda.ronda_id
 join tanzpaar2kategorie on tanzpaar2kategorie.id = tanzpaar2ronda.tanzpaar2kategorie_id
 join kategorie2stufe on kategorie2stufe.id = ronda.kategorie2stufe_id
 join stufe on stufe.id = kategorie2stufe.stufe_id
 join kategorie on kategorie.id = kategorie2stufe.kategorie_id
 join tanzpaar on tanzpaar.id = tanzpaar2kategorie.tanzpaar_id
 join teilnehmer teilnehmer1 on teilnehmer1.id = tango.tanzpaar.teilnehmer1_id
 join teilnehmer teilnehmer2 on teilnehmer2.id = tango.tanzpaar.teilnehmer2_id
 order by tango.kategorie.id, tango.stufe.id, tanzpaar2ronda.reihenfolge

