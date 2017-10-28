import React from 'react';
import ReactDOM from 'react-dom';
import Dropzone from 'react-dropzone';

export class PrintFiles extends React.Component
{
	constructor() {
		super();
		this.state = { 
			files: [],
			dropZoneActive: false,
			deleteStatus: false 
		};
	}

	onDrop(new_files) {
		new_files.push.apply(new_files,this.state.files);
		console.log(new_files);
		this.setState({
			files: new_files
		});
	}

	onDragEnter() {
		this.setState({
			dropZoneActive: true
		});
	}

	onDragLeave() {
		this.setState ({
			dropZoneActive: false
		});
	}

	sendFilesToPrinter() {
		var files = this.state.files;
		console.log(files);
		files.forEach( function(file) {
			console.log(file.name);
			console.log(file.type);
			console.log(file.size);
			this.uploadToDb(file);
		});
	}

	deleteFiles() {
		if(this.state.deleteStatus == false)
		{
			this.setState({
				deleteStatus: true
			});
		}
		
		else
		{
			this.setState({
				deleteStatus: false
			});
		}	
	}

	deleteFile(file) {
		if(this.state.deleteStatus)
		{
			var files = this.state.files;
			const index = files.indexOf(file);
			files.splice(index,1);
			this.setState({
				files: files
			});
		}	 
	}

	render() {
		return (
      <section>
        <div>
          <Dropzone
           disableClick 
           onDrop={this.onDrop.bind(this)}
           onDragEnter={this.onDragEnter.bind(this)}
           onDragLeave={this.onDragLeave.bind(this)}
           id="dropFile"
           >
          </Dropzone>
        </div>
		 <Dropzone
           onDrop={this.onDrop.bind(this)}
           id="clickFile"
           >
        </Dropzone>    
        <aside>
          <h2>Dropped files</h2>
          <ul>
            {
              this.state.files.map(f => (<li key={f.name} onClick={this.deleteFile.bind(this,f)}>{f.name}</li>))
            }
          </ul>
        </aside>
        <button type="button" onClick={this.sendFilesToPrinter.bind(this)}>Print</button>
      	<button type="button" onClick={this.deleteFiles.bind(this)}>Delete</button>
      </section>
    );
	}
}	