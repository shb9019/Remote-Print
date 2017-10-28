#!/bin/bash
i=1
for file in "$@"
do
if [ $file == '-u' ]
then
        break
fi
format="$(file -b $file|grep -oE '(OpenDocument|PDF|image|Word)')"
        if [ $format == 'OpenDocument' ]
        then
                mv $file input$i.odt
                unoconv -f pdf input$i.odt
        elif [ $format == 'image' ]
        then
                convert $file input$i.pdf
        elif [ $format == 'Word' ]
        then
                mv $file input$i.docx
                doc2pdf input$i.docx
        else
                mv $file input$i.pdf
        fi
i=$(($i+1))
done
eval user=\$$(($i+1))
eval pass=\$$(($i+3))
pdfunite input*.pdf output.pdf
gs -q -dNOPAUSE -dBATCH -dSAFER -sDEVICE=pxlmono -sOutputFile=output.pcl -f output.pdf
smbclient //octa.edu/A4 $pass -U $user -W octa.edu -I 10.0.0.38 -c "print output.pcl; exit;"
rm input*.pdf
